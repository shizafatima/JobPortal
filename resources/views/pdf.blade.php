<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Resume PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h1, h2 { color: #333; }
        .section { margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>{{ $resume->full_name }}</h1>
    <p><strong>Email:</strong> {{ $resume->email }}</p>
    <p><strong>Phone:</strong> {{ $resume->phone }}</p>
    <p><strong>LinkedIn:</strong> {{ $resume->linkedin }}</p>
    <p><strong>Address:</strong> {{ $resume->address }}</p>

    @if(!empty($resume->summary))
    <div class="section">
        <h2>Professional Summary</h2>
        <p>{{ $resume->summary }}</p>
    </div>
    @endif

    @if(!empty($resume->experience))
    <div class="section">
        <h2>Work Experience</h2>
        @foreach($resume->experience as $exp)
            <p><strong>{{ $exp['title'] }}</strong> at {{ $exp['company'] }}</p>
            <p>{{ $exp['start_date'] }} - {{ $exp['current'] ? 'Present' : $exp['end_date'] }}</p>
            <p>{{ $exp['description'] }}</p>
        @endforeach
    </div>
    @endif

    @if(!empty($resume->education))
    <div class="section">
        <h2>Education</h2>
        @foreach($resume->education as $edu)
            <p><strong>{{ $edu['degree'] }}</strong> at {{ $edu['institution'] }}</p>
            <p>{{ $edu['year'] }} | GPA: {{ $edu['gpa'] ?? 'N/A' }}</p>
        @endforeach
    </div>
    @endif

    @if(!empty($resume->skills))
    <div class="section">
        <h2>Skills</h2>
        <ul>
            @foreach($resume->skills as $skill)
                <li>{{ $skill }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</body>
</html>
