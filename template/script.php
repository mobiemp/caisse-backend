
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script src="../lib/dist/js/jquery.js"  ></script>
<script src="../lib/dist/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="../lib/dist/plugins/daterangepicker/daterangepicker.js"></script>
<script src="../lib/dist/js/adminlte.min.js?v=3.2.0"></script>


<script src="../lib/dist/JsBarcode.ean-upc.min.js"></script>
<script type="text/javascript">
    function imprimeEtiquettes(gencode,titre,prix){
        JsBarcode("#barcode2", gencode, {
            format:"EAN13",
            width:1.6,
            height:18,
            displayValue:true,
            fontSize:18,
            font:'cursive',
        });
        prix = prix.toFixed(2).toString();
        var splittedPrice = prix.split('.');
        var prixEntier = splittedPrice[0];
        var prixDecimal = splittedPrice[1];
        $('#titleEtiquette').html('') ;
        $('#prixEntier').text('');

        $('#prixEntier').append(prixEntier).append('<span>.'+prixDecimal+'€</span>');
        $('#titleEtiquette').append(titre);
        window.print();
    }
</script>
