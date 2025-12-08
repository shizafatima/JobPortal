@extends('layouts.plain')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl font-bold mb-6">ATS Resume Builder</h1>

            <div id="alert-container"></div>

            <form id="resumeForm" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">

                <!-- Personal Information -->
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold mb-4 border-b pb-2">Personal Information</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Full Name *</label>
                            <input type="text" name="full_name" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Email *</label>
                            <input type="email" name="email" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Phone *</label>
                            <input type="tel" name="phone" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">LinkedIn</label>
                            <input type="url" name="linkedin"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Address</label>
                            <input type="text" name="address"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                    </div>
                </div>

                <!-- Professional Summary -->
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold mb-4 border-b pb-2">Professional Summary</h2>
                    <textarea name="summary" rows="4"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Brief overview of your professional background and career objectives"></textarea>
                </div>

                <!-- Work Experience -->
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold mb-4 border-b pb-2">Work Experience</h2>
                    <div id="experienceContainer">
                        <div class="experience-item border p-4 mb-4 rounded">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Job Title</label>
                                    <input type="text" name="experience[0][title]"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Company</label>
                                    <input type="text" name="experience[0][company]"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Start Date</label>
                                    <input type="month" name="experience[0][start_date]"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">End Date</label>
                                    <input type="month" name="experience[0][end_date]"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <label class="inline-flex items-center mt-2">
                                        <input type="checkbox" name="experience[0][current]" class="form-checkbox">
                                        <span class="ml-2 text-sm">Currently working</span>
                                    </label>
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Responsibilities</label>
                                    <textarea name="experience[0][description]" rows="3"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        placeholder="Describe your key responsibilities and achievements"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="addExperienceBtn"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        + Add Experience
                    </button>
                </div>

                <!-- Education -->
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold mb-4 border-b pb-2">Education</h2>
                    <div id="educationContainer">
                        <div class="education-item border p-4 mb-4 rounded">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Degree</label>
                                    <input type="text" name="education[0][degree]"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Institution</label>
                                    <input type="text" name="education[0][institution]"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Year</label>
                                    <input type="number" name="education[0][year]" min="1950" max="2030"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">GPA (Optional)</label>
                                    <input type="text" name="education[0][gpa]"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="addEducationBtn"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        + Add Education
                    </button>
                </div>

                <!-- Skills -->
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold mb-4 border-b pb-2">Skills</h2>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Skills (comma separated)</label>
                        <textarea name="skills" rows="3"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="e.g., JavaScript, Python, Project Management, Communication"></textarea>
                    </div>
                </div>

                <!-- Certifications -->
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold mb-4 border-b pb-2">Certifications (Optional)</h2>
                    <div id="certificationContainer">
                        <div class="certification-item border p-4 mb-4 rounded">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Certification Name</label>
                                    <input type="text" name="certifications[0][name]"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Issuing Organization</label>
                                    <input type="text" name="certifications[0][organization]"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Year</label>
                                    <input type="number" name="certifications[0][year]" min="1950" max="2030"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="addCertificationBtn"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        + Add Certification
                    </button>
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-between mt-8">
                    <div>
                        <button type="button" id="saveResumeBtn"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                            Save
                        </button>

                        <button type="button" id="previewResumeBtn"
                            class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                            Preview
                        </button>

                        <button type="button" id="downloadResumeBtn"
                            class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                            Download
                        </button>

                    </div>
                    <div class="flex justify-center">
                        <button type="button" id="deleteResumeBtn"
                            class="bg-red-500 hover:bg-red-700 text-white mt-4 px-4 py-2 rounded">
                            Delete
                        </button>
                    </div>

                </div>

            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        function formToJson(form) {
            const formData = new FormData(form);
            let json = {};

            formData.forEach((value, key) => {
                // Handle array fields like experience[0][title]
                if (key.includes("[")) {
                    const keys = key.replace(/\]/g, "").split("[");
                    let current = json;

                    keys.forEach((k, i) => {
                        if (i === keys.length - 1) {
                            current[k] = value;
                        } else {
                            current[k] = current[k] || {};
                            current = current[k];
                        }
                    });
                } else {
                    json[key] = value;
                }
            });

            return json;
        }

        const form = document.getElementById('resumeForm');

        form.addEventListener('submit', function (e) {
            e.preventDefault(); // prevent reload if Enter key is pressed
        });

        // -------- Save Resume --------
        document.getElementById('saveResumeBtn').addEventListener('click', async function () {
            const data = formToJson(form);

            try {
                const res = await axios.post('/api/resume/save', data);
                const resumeId = res.data.resume_id;
                alert(res.data.message);

                // Store the ID for later use (preview, download, delete)
                form.dataset.resumeId = resumeId;
            } catch (err) {
                if (err.response && err.response.data.errors) {
                    console.error('Validation errors:', err.response.data.errors);
                    alert('Validation errors: ' + JSON.stringify(err.response.data.errors));
                } else {
                    console.error('Error saving resume:', err);
                    alert('Error saving resume');
                }
            }
        });

        // -------- Preview Resume --------
        document.getElementById('previewResumeBtn').addEventListener('click', function () {
            // Get saved resume ID from form dataset
            const resumeId = form.dataset.resumeId;

            if (!resumeId) {
                alert('Please save the resume first before previewing.');
                return;
            }

            // Open the preview page in a new tab
            window.open(`/resume/preview/${resumeId}`, '_blank');
        });


        // -------- Download Resume --------
        document.getElementById('downloadResumeBtn').addEventListener('click', function () {
            const resumeId = form.dataset.resumeId;

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
        // document.getElementById('downloadResumeBtn').addEventListener('click', async function () {
        //     const resumeId = form.dataset.resumeId;

        //     if (!resumeId) {
        //         alert('Please save the resume first before downloading.');
        //         return;
        //     }

        //     try {
        //         const response = await axios.get(`/api/resume/download/${resumeId}`, {
        //             responseType: 'blob' // very important for file download
        //         });

        //         const url = window.URL.createObjectURL(new Blob([response.data], { type: 'application/pdf' }));
        //         const link = document.createElement('a');
        //         link.href = url;
        //         link.setAttribute('download', `resume_${resumeId}.pdf`);
        //         document.body.appendChild(link);
        //         link.click();
        //         link.remove();
        //     } catch (err) {
        //         console.error('Error downloading resume PDF:', err);
        //         alert('Error downloading resume PDF');
        //     }
        // });

    </script>
@endsection

@push('scripts')
    @vite(['resources/js/app.js'])
@endpush