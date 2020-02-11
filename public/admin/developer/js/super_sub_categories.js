dataTable = $('#supersubcategory-table').DataTable({    fixedHeader: true,  "dom": 'C<"clear">lfrtip',    "colVis": {        "buttonText": "View columns"    },    "oLanguage": {        "sProcessing": "<img src='"+ASSET_URL+"admin/images/loading.gif' height='50' width='50'>"    },    "processing": true,    "serverSide": true,    "ajax":{        headers: {            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')        },        url : BASE_URL+'/admin/supersubcategory/getSuperSubCategoryData',         type: "post",          error: function(){              $(".user-table-error").html("");            $("#amenity-table").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');        }    },    "columnDefs": [ { orderable: false, targets: [0,3] }],    "order": [[ 2, 'desc' ]]});function deleteItem(id) {    var result = confirm("Are you sure you want to delete the user ?");    if (result) {        $('#ajaxLoader').show();        $.ajax({            headers: {                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')            },            url: BASE_URL+'/admin/supersubcategory/delete/'+id,            type: 'POST',            data: {},            success: function (data) {                location.reload();            },            error: function () {                console.log('There is some error in user deleting. Please try again.');            }        });    }}