@extends('layouts.plain')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white shadow-md rounded p-6">
            <h1 class="text-3xl font-bold mb-6">Resume Preview</h1>

            {{-- @php
            $data = session('resume_preview', []);
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
@endphp

            <!-- Personal Information -->
            <div class="mb-2">
                <h2 class="text-2xl font-semibold mb-2 border-b pb-1">Personal Information</h2>
                <p><strong>Name:</strong> {{ $resume->full_name ?? ''  }}</p>
                <p><strong>Email:</strong> {{ $resume->email ?? '' }}</p>
                <p><strong>Phone:</strong> {{ $resume->phone ?? '' }}</p>
                <p><strong>LinkedIn:</strong> {{ $resume->linkedin }}</p>
                <p><strong>Address:</strong> {{ $resume->address }}</p>
            </div>

            <!-- Professional Summary -->
            @if(!empty($resume->summary))
                <div class="mb-2">
                    <h2 class="text-2xl font-semibold mb-2 border-b pb-1">Professional Summary</h2>
                    <p>{{ $resume->summary }}</p>
                </div>
            @endif

            <!-- Work Experience -->
            @if(!empty($hasExperience))
                <div class="mb-2">
                    <h2 class="text-2xl font-semibold mb-2 border-b pb-1">Work Experience</h2>
                    @foreach($resume->experience as $exp)
                        <div class="mb-4">
                            @if(!empty($exp['title']) || !empty($exp['company']) || !empty($exp['start_date']) || !empty($exp['description']))
                                <div class="mb-2">
                                    @if(!empty($exp['title']) && !empty($exp['company']))
                                        <p><strong>{{ $exp['title'] }}</strong> at {{ $exp['company'] }}</p>
                                    @endif

                                    @if(!empty($exp['start_date']) || !empty($exp['end_date']) || isset($exp['current']))
                                        <p>{{ $exp['start_date'] ?? '' }} -
                                            {{ !empty($exp['current']) && $exp['current'] ? 'Present' : ($exp['end_date'] ?? '') }}</p>
                                    @endif

                                    @if(!empty($exp['description']))
                                        <p>{{ $exp['description'] }}</p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Education -->
            @if(!empty($resume->education))
                <div class="mb-2">
                    <h2 class="text-2xl font-semibold mb-2 border-b pb-1">Education</h2>
                    @foreach($resume->education as $edu)
                        <div class="mb-4">
                            <p><strong>{{ $edu['degree'] ?? '' }}</strong> at {{ $edu['institution'] ?? '' }}</p>
                            <p>{{ $edu['year'] ?? '' }} | GPA: {{ $edu['gpa'] ?? 'N/A' }}</p>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Skills -->
            @if(!empty($resume->skills))
                <div class="mb-2">
                    <h2 class="text-2xl font-semibold mb-2 border-b pb-1">Skills</h2>
                    <ul class="list-disc list-inside">
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