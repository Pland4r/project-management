<?php

namespace App\Exports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProjectsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Project::select(
            'reference',
            'name',
            'type',
            'start_date',
            'end_date',
            'etat',
            'person_name',
            'validator_name',
            'contreMarque',
            'commentaire',
            'issues'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Référence',
            'Nom',
            'Type',
            'Date Début',
            'Date Fin',
            'État',
            'Testeur',
            'Validateur',
            'Contre Marque',
            'Commentaire',
            'Issues',
        ];
    }
}
