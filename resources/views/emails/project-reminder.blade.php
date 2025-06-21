<x-mail::message>
# Project Starting Soon: {{ $project->name }}

**⏰ Starts in:** {{ $daysLeft }} days ({{ \Carbon\Carbon::parse($project->start_date)->format('F j, Y') }})  
**📍 Type:** {{ ucfirst($project->type) }}  
**👤 Responsible:** {{ $project->person_name }}  

<x-mail::panel>
**Project Details:**  
{{ $project->description ?? 'No additional details provided' }}
</x-mail::panel>

<x-mail::subcopy>
You're receiving this because you're listed as the responsible person for this project.  

</x-mail::subcopy>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>