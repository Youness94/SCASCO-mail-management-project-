<?php

namespace App\Exports;

use App\Models\Sinistre;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SinistreExport implements FromQuery, WithHeadings
{
    protected $date_debut;
    protected $date_fin;

    public function __construct($date_debut, $date_fin)
    {
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
    }

    // public function query()
    // {
    //     return Sinistre::query()
    //         ->whereDate('date_reception', '>=', $this->date_debut)
    //         ->whereDate('date_reception', '<=', $this->date_fin)
    //         ->with('branches_sinistres', 'compagnies', 'acte_de_gestion_sinistres', 'charge_compte_sinistres');

    // }
    public function query()
{
    return Sinistre::query()
        ->select(
            'sinistres.id',
            'sinistres.date_reception',
            'sinistres.nom_police',
            'sinistres.nom_assure',
            'sinistres.num_sinistre',
            'sinistres.nom_victime',
            'branches_sinistres.nom AS branche_name',
            'compagnies.nom AS company_name',
            'acte_de_gestion_sinistres.nom AS acte_gestion_name',
            'charge_compte_sinistres.nom AS charge_compte_name',
            'sinistres.date_traitement',
            'sinistres.date_remise',
            'sinistres.delai_traitement',
            'sinistres.observation',

        )
        ->join('branches_sinistres_at_rd AS branches_sinistres', 'sinistres.branche_sinistre_id', '=', 'branches_sinistres.id')
        ->join('compagnies', 'sinistres.compagnie_id', '=', 'compagnies.id')
        ->join('acte_de_gestion_sinistres_at_rd AS acte_de_gestion_sinistres', 'sinistres.acte_de_gestion_sinistre_id', '=', 'acte_de_gestion_sinistres.id')
        ->join('charge_compte_sinistres_at_rd AS charge_compte_sinistres', 'sinistres.charge_compte_sinistre_id', '=', 'charge_compte_sinistres.id')
        ->whereDate('sinistres.date_reception', '>=', $this->date_debut)
        ->whereDate('sinistres.date_reception', '<=', $this->date_fin);
}


    public function headings(): array
    {
        return [
            'ID',
            'Date Reception',
            'Nom Police',
            'Nom Assure',
            'Numero Sinistre',
            'Nom Victime',
            'Branche',
            'Company',
            'Acte Gestion',
            'Charge Compte',
            'Date de traitement',
            'Date de remise',
            'Délai de traitement',
            'Observation'

            
            // Add more columns as needed
        ];
    }
    public function map($sinistre): array
    {
        return [
            $sinistre->id,
            $sinistre->date_reception,
            $sinistre->nom_police,
            $sinistre->nom_assure,
            $sinistre->num_sinistre,
            $sinistre->nom_victime,
            $sinistre->branches_sinistres -> nom ?? '', // Get the 'nom' attribute from the related 'branches_sinistres' model
            $sinistre->compagnies -> nom ?? '', // Get the 'nom' attribute from the related 'compagnies' model
            $sinistre->acte_de_gestion_sinistres -> nom ?? '', // Get the 'nom' attribute from the related 'acte_de_gestion_sinistres' model
            $sinistre->charge_compte_sinistres -> nom ?? '', // Get the 'nom' attribute from the related 'charge_compte_sinistres' model
            $sinistre->date_traitement,
            $sinistre->date_remise,
            $sinistre->delai_traitement,
            $sinistre->observation,
            
            // Add more data fields as needed
        ];
    }
}
