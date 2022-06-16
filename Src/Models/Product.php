<?php

namespace MvcCore\Jtl\Models;

use MvcCore\Jtl\Database\Orm\Model;

class Product extends Model
{
    protected $table    = 'tartikel';

    protected $primaryKey  = 'kArtikel';

    protected $fillable = [

        'kHersteller', // kManufacturer
        'kLieferstatus', // kDelivery status
        'kSteuerklasse', // kTax class
        'kEinheit', // kUnit
        'kVersandklasse', // kShipping class
        'kEigenschaftKombi', // kPropertyCombination
        'kVaterArtikel', // kFatherArticle
        'kStueckliste', // kStock list
        'kWarengruppe', // kWare group
        'kVPEEinheit', // kVPE unit
        'kMassEinheit', // kMeasurement unit
        'kGrundPreisEinheit', // kPriceUnit
        'cSeo', // cSeo
        'cArtNr', // cArtNo
        'cName', // cName
        'cBeschreibung', // cDescription
        'cAnmerkung', // cNote
        'fLagerbestand', // fStock
        'fStandardpreisNetto', // fStandard priceNetto
        'fMwSt', // fMwSt
        'fMindestbestellmenge', // fMinimum order quantity
        'fLieferantenlagerbestand', // fSupplier inventory
        'fLieferzeit', // fDelivery time
        'cBarcode', // cBarcode
        'cTopArtikel', // cTopArticle
        'fGewicht', // fWeight
        'fArtikelgewicht', // fArticle weight
        'fMassMenge', // fMassQuantity
        'fGrundpreisMenge', // fPriceQuantity
        'fBreite', // fWidth
        'fHoehe', // fHeight
        'fLaenge', // fLength
        'cNeu', // cNew
        'cKurzBeschreibung', // cShortDescription
        'fUVP', // fUVP
        'cLagerBeachten', // cBearing Note
        'cLagerKleinerNull', // cCamp SmallNull
        'cLagerVariation', // cBearing variation
        'cTeilbar', // cDivisible
        'fPackeinheit', // fPacking unit
        'fAbnahmeintervall', // fAcceptance interval
        'fZulauf', // fInflow
        'cVPE', // cVPE
        'fVPEWert', // fVPEValue
        'cVPEEinheit', // cVee unit
        'cSuchbegriffe', // cSearch terms
        'nSort', // nSort
        'dErscheinungsdatum', // dEdition date
        'dErstellt', // dCreated
        'dLetzteAktualisierung', // dLastUpdate
        'dZulaufDatum', // dDeliveryDate
        'dMHD', // dMHD
        'cSerie', // cSeries
        'cISBN', // cISBN
        'cASIN', // cASIN
        'cHAN', // cHAN
        'cUNNummer', // cUNNumber
        'cGefahrnr', // cDangernr
        'cTaric', // cTaric
        'cUPC', // cUPC
        'cHerkunftsland', // cCountry of origin
        'cEPID', // cEPID
        'nIstVater', // nIstFather
        'nLiefertageWennAusverkauft', // nDeliveryDaysWhenSoldOut
        'nAutomatischeLiefertageberechnung', // nAutomaticDeliveryDateCalculationOut
        'nBearbeitungszeit' // nProcessing time

    ];
}
