<?php
namespace App\Exports;

use App\Models\Production;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductionExport implements FromQuery, WithHeadings
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
    return Production::query()
        ->select([
            'productions.id',
            'productions.date_reception',
            'productions.nom_police',
            'productions.nom_assure',
            'branches.nom AS branche_name',
            'compagnies.nom AS company_name',
            'act_gestions.nom AS acte_gestion_name',
            'charge_comptes.nom AS charge_compte_name',
            'productions.date_traitement',
            'productions.date_remise',
            'productions.delai_traitement',
            'productions.observation',
        ])
        ->join('branches', 'productions.branche_id', '=', 'branches.id')
        ->join('compagnies', 'productions.compagnie_id', '=', 'compagnies.id')
        ->join('act_gestions', 'productions.act_gestion_id', '=', 'act_gestions.id')
        ->join('charge_comptes', 'productions.charge_compte_id', '=', 'charge_comptes.id')
        ->whereBetween('productions.date_reception', [$this->date_debut, $this->date_fin]);
}


    public function headings(): array
    {
        return [
            'ID',
            'Date Reception',
            'Nom Police',
            'Nom Assure',
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
    public function map($production): array
    {
        return [
            $production->id,
            $production->date_reception,
            $production->nom_police,
            $production->nom_assure,
            $production->branches-> nom ?? '', // Assumes you have a 'branches' relationship in your Production model
            $production->compagnies-> nom ?? '', // Assumes you have a 'compagnies' relationship in your Production model
            $production->act_gestions-> nom ?? '', // Assumes you have an 'act_gestions' relationship in your Production model
            $production->charge_comptes-> nom ?? '', // Assumes you have a 'charge_comptes' relationship in your Production model
            $production->date_traitement,
            $production->date_remise,
            $production->delai_traitement,
            $production->observation,
            // Add more data fields as needed
        ];
    }
}
