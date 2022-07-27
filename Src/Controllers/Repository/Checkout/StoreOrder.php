<?php

namespace MvcCore\Jtl\Controllers\Repository\Checkout;

use JTL\Shop;
use JTL\Session\Frontend;
use JTL\Helpers\Request;
use MvcCore\Jtl\Models\shoppingCart;
use stdClass;

class StoreOrder
{

    public function store(array $values)
    {
        $db        = Shop::Container()->getDB();

        require PFAD_ROOT . PFAD_INCLUDES . 'bestellabschluss_inc.php';


        executeHook(HOOK_BESTELLABSCHLUSS_INC_BESTELLUNGINDB, ['oBestellung' => &$order]);

        if (isset($_POST['kommentar'])) {
            $_SESSION['kommentar'] = mb_substr(
                strip_tags(Shop::Container()->getDB()->escape($_POST['kommentar'])),
                0,
                1000
            );
        }

        $customer = Frontend::getCustomer();
        $cart = Frontend::getCart();


        $customerId = $customer->kKunde;
        $languageId = $customer->kSprache;
        $balance = $values['totalAmount'];
        $retrieving = $customer->cAbgeholt;

        $shopping = new shoppingCart;
        $cartVariable = $shopping->select(
            'kWarenkorb',
            'kKunde',
            'kLieferadresse',
            'kZahlungsInfo'
        )->where('kKunde', $customerId)->get();

        $shoppingCartId = $cartVariable['0']->kWarenkorb;
        $shippingAddressId = $cartVariable['0']->kLieferadresse;
        $currencyId = Frontend::getCurrency()->getID();

        $paymentMethodType = 73;
        $paymentMethodName  = $_SESSION['Versandart']->angezeigterName[$_SESSION['cISOSprache']] ?? '';
        $shippingMethodType = $_SESSION['Versandart']->kVersandart ?? '';
        $shippingMethodName = $_SESSION['Zahlungsart']->angezeigterName[$_SESSION['cISOSprache']] ?? '';
        $totalAmount = $cart->gibGesamtsummeWaren(true);
        $conversionFactor = Frontend::getCurrency()->getConversionFactor();
        $cIP = $_SESSION['IP']->cIP ?? Request::getRealIP();

        $sessionId         = session_id();
        $commentMessage     = $_SESSION['kommentar'] ?? '';

        $obj                       = new stdClass();
        $obj->kWarenkorb           = $shoppingCartId;
        $obj->kKunde               = $customerId;
        $obj->kLieferadresse       = $shippingAddressId;
        $obj->kRechnungsadresse    = $values['address'];
        $obj->kZahlungsart         = $paymentMethodType;
        $obj->kVersandart          = $shippingMethodType;
        $obj->kSprache             = $languageId;
        $obj->kWaehrung            = $currencyId;
        $obj->fGuthaben            = $balance;
        $obj->fGesamtsumme         = $balance;
        $obj->cSession             = $sessionId;
        $obj->cVersandartName      = $shippingMethodName ?? 'DHL';
        $obj->cZahlungsartName     = 'paypal';
        $obj->cBestellNr           = $values['id'];
        $obj->cVersandInfo         = '';
        $obj->nLongestMinDelivery  = 2;
        $obj->nLongestMaxDelivery  = 3;
        $obj->dVersandDatum        = '';
        $obj->dBezahltDatum        = '';
        $obj->dBewertungErinnerung = '';
        $obj->cTracking            = '';
        $obj->cKommentar           = '';
        $obj->cLogistiker          = '';
        $obj->cTrackingURL         = '';
        $obj->cIP                  = $cIP;
        $obj->cAbgeholt            = $retrieving;
        $obj->cStatus              = 1; // 1: new , 2: in progress , 3: paid
        $obj->dErstellt            = $values['creationTime'];
        $obj->fWaehrungsFaktor     = $conversionFactor;
        $obj->cPUIZahlungsdaten    = '';

        $orderTableId = $db->insert('tbestellung', $obj);


    // OrderAttributes
    if (!empty($_SESSION['Warenkorb']->OrderAttributes)) {
        foreach ($_SESSION['Warenkorb']->OrderAttributes as $orderAttr) {
            $obj              = new stdClass();
            $obj->kBestellung = $orderTableId;
            $obj->cName       = $orderAttr->cName;
            $obj->cValue      = $orderAttr->cName === 'Finanzierungskosten'
                ? (float)str_replace(',', '.', $orderAttr->cValue)
                : $orderAttr->cValue;
                $db->insert('tbestellattribut', $obj);
        }
    }

    $logger = Shop::Container()->getLogService();
    if ($logger->isHandling(JTLLOG_LEVEL_DEBUG)) {
        $logger->withName('kBestellung')->debug('Bestellung gespeichert: ' . print_r($order, true), [$orderID]);
    }



        //BestellID füllen
        $bestellid              = new stdClass();
        $bestellid->cId         = uniqid('', true);
        $bestellid->kBestellung = $orderTableId;
        $bestellid->dDatum      = date('m/d/Y h:i:s a', time());
        $db->insert('tbestellid', $bestellid);
        //bestellstatus füllen
        $bestellstatus              = new stdClass();
        $bestellstatus->kBestellung = $orderTableId;
        $bestellstatus->dDatum      = date('m/d/Y h:i:s a', time());
        $bestellstatus->cUID        = uniqid('', true);
        $db->insert('tbestellstatus', $bestellstatus);


        executeHook(HOOK_BESTELLABSCHLUSS_INC_BESTELLUNGINDB_ENDE, [
            'oBestellung'   => &$obj,
            'bestellID'     => &$bestellid,
            'bestellstatus' => &$bestellstatus,
        ]);
    }
}
