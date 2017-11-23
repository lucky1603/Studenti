<?php
namespace Studenti\Model;

class Kurs
{
    public $id;
    public $student_id;
    public $predmet_id;
    public $prisustvo;
    public $broj_casova;
    public $samostalni_zadaci;
    public $kolokvijum_1_poeni;
    public $kolokvijum_1_datum;
    public $kolokvijum_2_poeni;
    public $kolokvijum_2_datum;
    public $pismeni_datum;
    public $pismeni_poeni;
    public $usmeni_datum;
    public $usmeni_poeni;
    public $poeni_ukupno_do_usmenog;
    public $poeni_zbir;
    public $ocena;
    public $napomene;
    public $imePredmeta;
    public $imeProfesora;
    public $imeStudenta;
    public $prezimeStudenta;
    public $brojIndeksa;
    
    public function exchangeArray($data)
    {
        $this->id = isset($data['id']) ? $data['id'] : null;    
        $this->student_id = isset($data['student_id']) ? $data['student_id'] : null;
        $this->predmet_id = isset($data['predmet_id']) ? $data['predmet_id'] : null;
        $this->prisustvo = isset($data['prisustvo']) ? $data['prisustvo'] : null;
        $this->broj_casova = isset($data['broj_casova']) ? $data['broj_casova'] : null;
        $this->samostalni_zadaci = isset($data['samostalni_zadaci']) ? $data['samostalni_zadaci'] : null;
        $this->kolokvijum_1_poeni = isset($data['kolokvijum_1_poeni']) ? $data['kolokvijum_1_poeni'] : null;
        $this->kolokvijum_1_datum = isset($data['kolokvijum_1_datum']) ? $data['kolokvijum_1_datum'] : null;
        $this->kolokvijum_2_poeni = isset($data['kolokvijum_2_poeni']) ? $data['kolokvijum_2_poeni'] : null;
        $this->kolokvijum_2_datum = isset($data['kolokvijum_2_datum']) ? $data['kolokvijum_2_datum'] : null;
        $this->pismeni_datum = isset($data['pismeni_datum']) ? $data['pismeni_datum'] : null;
        $this->pismeni_poeni = isset($data['pismeni_poeni']) ? $data['pismeni_poeni'] : null;
        $this->usmeni_datum = isset($data['usmeni_datum']) ? $data['usmeni_datum'] : null;
        $this->poeni_ukupno_do_usmenog = isset($data['poeni_ukupno_do_usmenog']) ? $data['poeni_ukupno_do_usmenog'] : null;
        $this->poeni_zbir = isset($data['poeni_zbir']) ? $data['poeni_zbir'] : null;
        $this->ocena = isset($data['ocena']) ? $data['ocena'] : null;
        $this->napomene = isset($data['napomene']) ? $data['napomene'] : null;
        $this->imePredmeta = isset($data['imePredmeta']) ? $data['napomene'] : null;
        $this->napomene = isset($data['napomene']) ? $data['napomene'] : null;
        $this->imePredmeta = isset($data['imePredmeta']) ? $data['imePredmeta'] : null;
        $this->imeProfesora = isset($data['imeProfesora']) ? $data['imeProfesora'] : null;
        $this->imeStudenta = isset($data['imeStudenta']) ? $data['imeStudenta'] : null;
        $this->prezimeStudenta = isset($data['prezimeStudenta']) ? $data['prezimeStudenta'] : null;
        $this->brojIndeksa = isset($data['brojIndeksa']) ? $data['brojIndeksa'] : null;
    }
    
    public function getArrayCopy()
    {
        return [
            'id' => $this->id,
            'student_id' => $this->student_id,
            'predmet_id' => $this->predmet_id,
            'prisustvo' => $this->prisustvo,
            'broj_casova' => $this->broj_casova,
            'samostalni_zadaci' => $this->samostalni_zadaci,
            'kolokvijum_1_poeni' => $this->kolokvijum_1_poeni,
            'kolokvijum_1_datum' => $this->kolokvijum_1_datum,
            'kolokvijum_2_poeni' => $this->kolokvijum_2_poeni,
            'kolokvijum_2_datum' => $this->kolokvijum_2_datum,
            'pismeni_datum' => $this->pismeni_datum,
            'pismeni_poeni' => $this->pismeni_poeni,
            'usmeni_datum' => $this->usmeni_datum,
            'poeni_ukupno_do_usmenog' => $this->poeni_ukupno_do_usmenog,
            'poeni_zbir' => $this->poeni_zbir,
            'ocena' => $this->ocena,
            'napomene' => $this->napomene,       
            'imePredmeta' => $this->imePredmeta,
            'imeProfesora' => $this->imeProfesora,
            'imeStudenta' => $this->imeStudenta,
            'prezimeStudenta' => $this->prezimeStudenta,
            'brojIndeksa' => $this->brojIndeksa,
        ];
    }
}

