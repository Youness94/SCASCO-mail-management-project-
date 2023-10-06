<?php

namespace App\Exports;

use App\Models\SinistreDim;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SinistreDimExport implements FromQuery, WithHeadings
{
    protected $date_debut;
    protected $date_fin;

    public function __construct($date_debut, $date_fin)
    {
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
    }

    public function query()
{
    return SinistreDim::query()
        ->select([
            'sinistres_dim.id',
            'sinistres_dim.date_reception',
            'sinistres_dim.num_declaration',
            'sinistres_dim.nom_adherent',
            'sinistres_dim.nom_assure',
            'branches_dim.nom AS branche_name',
            'compagnies.nom AS company_name',
            'acte_gestions_dim.nom AS acte_gestion_name',
            'charges_comptes_dim.nom AS charge_compte_name',
            'sinistres_dim.date_traitement',
            'sinistres_dim.date_remise',
            'sinistres_dim.delai_traitement',
            'sinistres_dim.observation'
        ])
        ->join('branches_dim', 'sinistres_dim.branche_dim_id', '=', 'branches_dim.id')
        ->join('compagnies', 'sinistres_dim.compagnie_id', '=', 'compagnies.id')
        ->join('acte_gestions_dim', 'sinistres_dim.acte_gestion_dim_id', '=', 'acte_gestions_dim.id')
        ->join('charges_comptes_dim', 'sinistres_dim.charge_compte_dim_id', '=', 'charges_comptes_dim.id')
        ->whereBetween('sinistres_dim.date_reception', [$this->date_debut, $this->date_fin]);
}


    public function headings(): array
    {
        return [
            'ID',
            'Date Reception',
            'N° de déclaration',
            'Nom Assuré',
            'Nom Adhèrent',
            'Branche',
            'Company',
            'Acte Gestion',
            'Charge Compte',
            'Date de traitement',
            'Date de remise',
            'Délai de traitement',

            
            // Add more columns as needed
        ];
    }
    public function map($sinistre_dim): array
    {
        return [
            $sinistre_dim->id,
            $sinistre_dim->date_reception,
            $sinistre_dim->num_declaration,
            $sinistre_dim->nom_assure,
            $sinistre_dim->nom_adherent,
            $sinistre_dim->branches_dim->nom, // Assumes you have a 'branches' relationship in your Production model
            $sinistre_dim->compagnies->nom, // Assumes you have a 'compagnies' relationship in your Production model
            $sinistre_dim->acte_de_gestion_dim->nom, // Assumes you have an 'act_gestions' relationship in your Production model
            $sinistre_dim->charge_compte_dim->nom, // Assumes you have a 'charge_comptes' relationship in your Production model
            $sinistre_dim->date_traitement,
            $sinistre_dim->date_remise,
            $sinistre_dim->delai_traitement,

            
            // Add more data fields as needed
        ];
    }
}
