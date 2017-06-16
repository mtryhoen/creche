<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Facture</title>
    
    <style>
    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:30px;
        border:1px solid #eee;
        box-shadow:0 0 10px rgba(0, 0, 0, .15);
        font-size:16px;
        line-height:24px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;
    }
    
    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }
    
    .invoice-box table td{
        padding:5px;
        vertical-align:top;
    }
    
    .invoice-box table tr td:nth-child(2){
        text-align:right;
    }
    
    .invoice-box table tr.top table td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:45px;
        color:#333;
    }
    
    .invoice-box table tr.information table td{
        padding-bottom:40px;
    }
    
    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }
    
    .invoice-box table tr.details td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }
    
    .invoice-box table tr.item.last td{
        border-bottom:none;
    }
    
    .invoice-box table tr.total td:nth-child(2){
        border-top:2px solid #eee;
        font-weight:bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }
        
        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                Crèche Les Bambis
                            </td>
                            
                            <td>
                                Facture #: 123<br>
                                Période: {{$month}}/{{$year}}<br>
                                Paiement à effectuer pour la fin du mois suivant.
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Rue des Pinsons, 21
                            <br>    
                                6110 Montigny-le-Tilleul
                            </td>
                            
                            <td>
                                Téléphone: 071/92.39.70
                                <br>
                                Fax: 071/92.39.71
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Méthode de paiement
                </td>
                
                <td>
                    Numéro de compte
                </td>
            </tr>
            
            <tr class="details">
                <td>
                    Virement bancaire
                </td>
                
                <td>
                    BExx-xxxx
                </td>
            </tr>

            <tr class="heading">
                <td>
                    Enfant
                </td>
                
                <td>
                    Tarif journalier
                </td>
            </tr>
            
            <tr class="details">
                <td>
                    {{$fullname}}
                </td>
                
                <td>
                    {{$tariffull}} €
                </td>
            </tr>

            <tr class="heading">
                <td>
                    
                </td>
                
                <td>
                    Tarif demie journée
                </td>
            </tr>
            
            <tr class="details">
                <td>
                    
                </td>
                
                <td>
                    {{$tarifhalf}} €
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Journées
                </td>
                
                <td>
                    Prix
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    {{$dateAMPM}} jours
                </td>
                
                <td>
                    {{$billfull}} €
                </td>
            </tr>

            <tr class="heading">
                <td>
                    Demies journées
                </td>
                
                <td>
                    Prix
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    {{$datedemi}} demis jours
                </td>
                
                <td>
                    {{$billdemi}} €
                </td>
            </tr>
            
            <tr class="total">
                <td></td>
                
                <td>
                   Total: {{$billtot}} €
                </td>
            </tr>
        </table>
    </div>
</body>

</html>