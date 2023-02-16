<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
</head>
<body>
<div class="container">

    <select id='sel_name'>
      <option value=''>-- Select Gender --</option>
      <option value='Mr. Enoch Feest III'>Mr. Enoch Feest III</option>
      <option value='Mr. Randi Ryan DVM'>Mr. Randi Ryan DVM</option>
      <option value='Casper Gutkowski'>Casper Gutkowski</option>
      <option value='Ervin Schuppe'>Ervin Schuppe</option>
   </select>

    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>



<script>
    $(document).ready(function () {
        var stuTable=$('#example').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ],
            dom: 'Bfrtip',
            // 'pageLength'
            buttons: [
                'pageLength','copy', 'csv', 'excel', 'pdf', 'print'
            ], 
                                                                              
            "ajax": {
                "url" : '/show',
                "type":'GET',
                "dataType":'json',
                // "data":{_token:"{{csrf_token()}}"}
                //for custom filter start
                data: function(data){
                    data.searchName = $('#sel_name').val();
                 }
                //for custom filter end
            },
            "columns":[
                {"data":"id"},
                {"data":"name"},
                {"data":"email"},
                {"data":"mobile"},
                {"data":"action"}
            ]
        });

        //for custom filter start
          $('#sel_name').change(function(){
             stuTable.draw();
          });
        //for custom filter start

    });
</script>
</body>
</html>