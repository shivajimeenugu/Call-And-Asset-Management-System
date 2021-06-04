<table id="tblCustomers" cellspacing="0" cellpadding="0">
    <tr>
        <th>Customer Id</th>
        <th>Name</th>
        <th>Country</th>
    </tr>
    <tr>
        <td>1</td>
        <td>John Hammond</td>
        <td>United States</td>
    </tr>
    <tr>
        <td>2</td>
        <td>Mudassar Khan</td>
        <td>India</td>
    </tr>
    <tr>
        <td>3</td>
        <td>Suzanne Mathews</td>
        <td>France</td>
    </tr>
    <tr>
        <td>4</td>
        <td>Robert Schidner</td>
        <td>Russia</td>
    </tr>
</table>
<br />
<input type="button" id="btnExport" value="Export" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="table2excel.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $("#btnExport").click(function () {
            $("#tblCustomers").table2excel({
                filename: "Table.xls"
            });
        });
    });
</script>