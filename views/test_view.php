<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <a style="display: none;" tp="new" target="_blank" id="doc_download" href="<?php echo site_url('uploads/report.pdf'); ?>">2345</a>
    <a style="display: none;" tp="new" target="_blank" id="doc_all_download" href="<?php echo site_url('uploads/report_all.pdf'); ?>">printall</a>

</head>

<body>
    <form method="post" id="frmcreatemodels" action="<?php echo base_url('Test/save'); ?>" class="form-horizontal">

        <div>
            <table id="table_products" class="table table-responsive" cellspacing="0" width="100%">

                <!-- <thead> -->
                <tbody>
                    <tr>
                        <td>Name</td>

                        <td>Quantity</td>
                        <td>Unit Price</td>
                        <td>Tax</td>
                        <td>Total</td>
                        <td>Sub Total With Tax</td>
                        <td>Sub total without Tax</td>
                       
                        <td>submit</td>

                        
                    </tr>
                    <tr>
                        <td><input id="name" value="" class="form-control" name="name" type="text" /></td>
                        <td><input id="quantity" value="" class="form-control" name="quantity" type="text" maxlength="50" /></td>
                        <td><input id="price" value="" class="form-control" name="price" type="text" maxlength="50" /></td>
                        <td><input id="tax" value="" class="form-control" name="tax" type="text" maxlength="50" /></td>
                        <td><input id="total" value="" class="form-control" name="total" type="text" maxlength="50" readonly /></td>
                        <td><input id="with_tax" value="" class="form-control" name="with_tax" type="text" maxlength="50" readonly /></td>
                        <td><input id="without_tax" value="" class="form-control" name="without_tax" type="text" maxlength="50" readonly /></td>



                        <td> <button data-toggle="tooltip" type="button" title="Add To save" id="btnAddExtra" class="btn btn-success" href="#">

                                <span class="glyphicon glyphicon-plus"></span> </button> </td>




                    </tr>
                </tbody>
               
                <tbody id='addrow' class="table table-responsive">
                </tbody>
            </table>
        </div>
        <div align="center" class="box-footer">

            <input type="submit" name="create_pdf" class="btn btn-danger" value="Save & Create PDF" />


        </div>
    </form>

</body>

</html>

<script type="text/javascript">
  
    $("#btnAddExtra").click(function() {
        if ($('#name').val() == '' || $('#quantity').val() == '' || $('#price').val() == '') {
            alert('Please Select data');
        } else {
        var name = $('#name').val();
        var quantity = $('#quantity').val();
        var price = $('#price').val();
        var tax = $('#tax').val();
        var total = quantity * price;
        var with_tax = total + (tax / 100) * total;
        var without_tax = total;
        
         grand_tot = parseFloat(grand_tot) + total;
        alert(grand_tot);

        var unique_id = '';

        add_data(name, quantity, unique_id, price, tax, total, with_tax, without_tax);
        }
    });

    function add_data(name, quantity, unique_id, price, tax, total, with_tax, without_tax) {
        $('#name').val('');
        $('#quantity').val('');
        $('#price').val('');
        $('#tax').val('');
        $("#total").val('');
        $('#with_tax').val('');
        $('#without_tax').val('');

        var newrow = " <tr id='myTableRow'><td><input id='name' value='" + name + "' class='form-control' name='name[]' type='text' /></td>";
        newrow = newrow + '<td><input type="text" id="quantity" value="' + quantity + '" class="form-control" name="quantity[]"" /></td>';
        newrow = newrow + "<td><input id='price' value='" + price + "' class='form-control' name='price[]' type='text'/></td>";
        newrow = newrow + "<td><input id='tax' value='" + tax + "' class='form-control' name='tax[]' type='text'/></td>";
        newrow = newrow + "<td><input id='total' value='" + total + "' class='form-control' name='total[]' type='text' readonly /></td>";
        newrow = newrow + "<td><input id='with_tax' value='" + with_tax + "' class='form-control' name='with_tax[]' type='text' readonly/></td>";
        newrow = newrow + "<td><input id='without_tax' value='" + without_tax + "' class='form-control' name='without_tax[]' type='text' readonly/></td>";

        
        newrow = newrow + "<td><button data-toggle='tooltip' type='button' title='Delete' id='remove' class='btn btn-danger remove' href='#'><span class='glyphicon glyphicon-remove'></span></button></td>";
      


        $('#addrow').append(newrow);

    }
    $(document).on('click', ".remove", function() {
        $('.tooltip').remove();
        $(this).closest('tr').remove();
        //calcrow();
    });
</script>