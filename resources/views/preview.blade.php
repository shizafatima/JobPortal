@extends('layouts.plain')
@php
    use Carbon\Carbon;
@endphp

@section('content')
    <div class="container mx-auto px-4 py-8 font-[arial]">
        <div class="max-w-4xl mx-auto bg-white shadow-md rounded p-6">
            <h1 class="text-2xl font-bold mb-6">Resume Preview</h1>

            {{-- @php
            $data = session('resume_preview', []);
            @endphp --}}

            {{-- @php
            $lines = preg_split('/\r\n|\r|\n/', $exp['description']);
            @endphp --}}
            @php
                $hasExperience = false;
                if (!empty($resume->experience)) {
                    foreach ($resume->experience as $exp) {
                        if (!empty($exp['title']) || !empty($exp['company']) || !empty($exp['start_date']) || !empty($exp['description'])) {
                            $hasExperience = true;
                            break;
                        }
                    }
                }

                $hasEducation = false;
                if (!empty($resume->education)) {
                    foreach ($resume->education as $edu) {
                        if (!empty($edu['degree']) || !empty($edu['institution']) || !empty($edu['year']) || !empty($edu['gpa'])) {
                            $hasEducation = true;
                            break;
                        }
                    }
                }

                $hasSkills = false;
                if (!empty($resume->skills) && is_array($resume->skills) && count($resume->skills) > 0) {
                    $hasSkills = true;
                }

                $hasCertificates = false;
                if (!empty($resume->certifications)) {
                    foreach ($resume->certifications as $cert) {
                        if (!empty($cert['name']) || !empty($cert['issuer']) || !empty($cert['date'])) {
                            $hasCertificates = true;
                            break;
                        }
                    }
                }
            @endphp

            <!-- Personal Information -->
            <div class="mb-2 border-b pb-1">
                <div>
                    <h2 class="text-3xl font-bold ">{{ $resume->full_name ?? ''  }}</h2>
                    <p>
                        <strong>Name:</strong> {{ $resume->email ?? '' }} |
                        <strong>Phone no:</strong> {{ $resume->phone ?? '' }} |
                        <strong>Address:</strong> {{ $resume->address ?? '' }}

                        <span>
                            @if (!empty($resume->linkedin))
                                {{ ('|') . (' ') . ($resume->linkedin ?? '') }}
                            @endif
                        </span>
                    </p>
                </div>
            </div>

            <!-- Professional Summary -->
            @if(!empty($resume->summary))
                <div class="mb-2">
                    <h2 class="text-sm font-bold mb-2 border-b pb-1">Professional Summary</h2>
                    <ul class="list-disc list-inside">
                        <li class="mb-1">
                            {{ $resume->summary }}
                        </li>
                    </ul>

                </div>
            @endif

            <!-- Work Experience -->
            @if(!empty($hasExperience))
                <div class="mb-2">
                    <h2 class="text-lg font-bold mb-2 border-b pb-1">Work Experience</h2>
                    @foreach($resume->experience as $exp)
                        <div class="mb-4 text-sm">
                            <div class="mb-2">
                                <ul class="list-disc list-inside flex row">
                                    <li class="mb-1"><strong>{{ $exp['title'] }}</strong> at {{ $exp['company'] }}</li>
                                    @php
                                        $start = !empty($exp['start_date']) ? Carbon::parse($exp['start_date'])->format('F Y') : '';
                                        $end = (!empty($exp['current']) && $exp['current']) ? 'Present' : (!empty($exp['end_date']) ? Carbon::parse($exp['end_date'])->format('F Y') : '');
                                    @endphp
                                    <span>&nbsp;({{ $start }} - {{ $end }})</span>
                                </ul>
                                @php
                                    $lines = preg_split('/\r\n|\r|\n/', $exp['description']);
                                @endphp
                                <ul class="list-[circle] ml-12">
                                    @foreach ($lines as $line)
                                        @if(trim($line) !== '')
                                            <li class="mb-1">{{ $line }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Education -->
            @if(!empty($hasEducation))
                <div class="mb-2">
                    <h2 class="text-lg font-bold mb-2 border-b pb-1">Education</h2>
                    @foreach($resume->education as $edu)
                        <div class="mb-4">
                            <ul>
                                <li><strong>{{ $edu['degree'] ?? '' }}</strong> at
                                    {{ $edu['institution'] ?? '' | $edu['year' ?? '']}}</li>
                                {{-- <p>{{ $edu['year'] ?? '' }} | GPA: {{ $edu['gpa'] ?? 'N/A' }}</p> --}}
                                <span>
                                    @if (!empty($resume->gpa))
                                        | GPA: {{ ($resume->gpa ?? '') }}
                                    @endif
                                </span>
                            </ul>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Certifications -->
            @if(!empty($hasCertificates))
                <div class="mb-2">
                    <h2 class="text-lg font-bold mb-2 border-b pb-1">Certifications</h2>
                    @foreach($resume->certifications as $cert)
                        <div class="mb-4">
                            <p><strong>{{ $cert['name'] ?? '' }}</strong> by {{ $cert['organization'] ?? '' }}</p>
                            <p>{{ !empty($cert['year'])  }}</p>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Skills -->
            @if(!empty($hasSkills))
                <div class="mb-2">
                    <h2 class="text-lg font-bold mb-2 border-b pb-1">Skills</h2>
                    <ul class="list-disc list-inside text-sm">
                        @foreach($resume->skills as $skill)
                            <li>{{ $skill }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex items-center justify-end mt-8">
                <button type="button" id="downloadResumeBtn"
                    class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                    Download PDF
                </button>
            </div>
        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.getElementById('downloadResumeBtn').addEventListener('click', function () {
            const resumeId = "{{ $resume->id }}";

            axios({
                url: `/resume/download/${resumeId}`,
                method: 'GET',
                responseType: 'blob', // crucial for PDF
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // optional for GET
                }
            })
                .then(response => {
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', 'resume.pdf');
                    document.body.appendChild(link);
                    link.click();
                    link.remove();
                })
                .catch(error => {
                    console.error('Download failed:', error);
                    alert('Failed to download resume.');
                });
        });
    </script>
@endsection