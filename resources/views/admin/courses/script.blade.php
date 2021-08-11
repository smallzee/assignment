
	<script src="https://pagination.js.org/dist/2.1.4/pagination.min.js"></script>
	<script>
		let rows = []
		$('table tbody tr').each(function(i, row) {
			return rows.push(row);
		});

		$('#pagination').pagination({
			dataSource: rows,
			pageSize: 5,
			callback: function(data, pagination) {
				$('tbody').html(data);
			}
		})
		function searchTable() {			
            var input, filter, table, tr, td, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("showTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                var x = $("#myInput").val();
                var regex = /^[a-zA-Z]+$/;
                if (!x.match(regex)) {
                    td = tr[i].getElementsByTagName("td")[0];
                }
                if (td) {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
		}

  function filter_vitals() {
    // $('#waitingList').dataTable().fnClearTable();
    // //dataTable.fnClearTable();
    // $('#waitingList').dataTable().fnDraw();
    // $('#waitingList').dataTable().fnDestroy();
    //$('#defaultPatients').hide();
    //var status = document.getElementById('status').value;
    var faculty_id = document.getElementById('faculty_id').value;
    var department_id = document.getElementById('department_id').value;
    var level = document.getElementById('level').value;
    var semester = document.getElementById('semester').value;
    //console.log(level);

    listPatients();

    //$('#filteredPatients').show();
    //  var prescriptionTable =  $('#prescriptionMasterList').DataTable({
    //         dom: 'lrtip',
    //         "lengthChange": false
    //     });
    // // #myInput is a <input type="text"> element
    // $('#myInput').on( 'keyup', function () {
    //     prescriptionTable.search( this.value ).draw();
    // } );  


    // list all employee in datatable
    function listPatients() {
      $.ajax({
      type  : 'post',
      url   : "{{ url('admin/filter-course')}}",
      data: {
        "_token": "{{ csrf_token() }}",
          faculty_id: faculty_id,
          semester: semester,
          level: level,
          department_id: department_id
        },
      async : false,
      dataType : 'json',
      success : function(response){
        console.log(response);
        var html = '';
        var i;
        var sn =1;
        for(i=0; i<response.length; i++){

            if (response[i].vital_id != null) {
              var fullname = response[i].staff_firstname + ' ' + response[i].staff_lastname;
              var vital_status = '<span class="badge badge-success">Treated</span>';
            } else {
              var fullname = "";
              var vital_status = '<span class="badge badge-warning">Pending</span>';
            }
           
            html += '<tr><td>' + sn++ + '</td> <td>' + response[i].appointment_date +
              '</td> <td>' + response[i].appointment_time +
              '</td> <td>' + response[i].patient_title + ' ' + response[i].patient_name +
              '</td> <td>' + response[i].patient_gender +
              '</td> <td>' + response[i].patient_id_num +
              '</td> <td>' + response[i].patient_status +
              '</td> <td>' + response[i].clinic_name +
              '</td><td>' + fullname;
          }
          $('#filtered_vitals').html(html);
        }

      });
    }


  }
</script>