<x-mail::message>
# Essai/Messure Starting Soon: {{ $essaiMessure->name }}

**⏰ Starts in:** {{ $daysLeft }} days ({{ \Carbon\Carbon::parse($essaiMessure->start_date)->format('F j, Y') }})  
**📍 Type:** {{ ucfirst($essaiMessure->type) }}  
**👤 Responsible:** {{ $essaiMessure->person_name }}  

<x-mail::panel>
**Essai/Messure Details:**  
{{ $essaiMessure->commentaire ?? 'No additional details provided' }}
</x-mail::panel>

<x-mail::subcopy>
You're receiving this because you're listed as the responsible person for this essai/messure.  
</x-mail::subcopy>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>