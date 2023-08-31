<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h6>Manager Page</h6>
                    </div>
                    <div class="align-items-center col">
                        {{-- <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0 btn-sm bg-gradient-primary">Create </button> 
                        <a href="" class="float-end btn m-0 btn-sm bg-gradient-primary">add new request</a> --}}
                        {{-- <a href="{{url("/leaveRequestPage")}}"><button class="float-end btn m-0 btn-sm bg-gradient-success">add new request ee </button> </a> --}}
                    </div>
                </div>

                <hr class="bg-secondary"/>
                <div class="table-responsive">
                    <table class="table  table-flush" id="tableData">
                        <thead>
                            <tr class="bg-light">
                                <th>No</th> 
                                <th>Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>reason</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableList">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    gellLeaveRequestForManager();    

    async function gellLeaveRequestForManager(){
        showLoader();
        let response = await axios.get('/leave-list-manager');
        hideLoader();

        let tableList = $("#tableList");
        let tableData = $("#tableData");

        tableData.DataTable().destroy();
        tableList.empty();

        response.data.forEach(function(item, index){
            let row = `
                <tr>              
                    <td>${index+1}</td>
                    <td>${item['user']['name']}</td>
                    <td>${item['start_date']}</td>
                    <td>${item['end_date']}</td>
                    <td>${item['reason']}</td>
                    <td>${item['leave_category']['name']}</td>
                    <td>${item['status']}</td>  
                    <td>
                        <button data-id="${item['id']}" class="btn editBtn btn-sm btn-success">Edit</button>
                        
                    </td>            
                </tr>
            `
            tableList.append(row);
        })

        $(".editBtn").on('click',async function(){
            let id = $(this).data('id');
            await fillUpLeaveForm(id);
            // $("#updateID").val(id);
            $("#update-modal").modal('show');
            
        })

        new DataTable('#tableData',{
            order:[[0,'desc']],
            lengthMenu:[5,10,15,20,30]
        });



    }

</script>



{{-- <script>

    getAllLeaveRequestForManager();

    async function getAllLeaveRequestForManager(){
        showLoader();
        let response = await axios.get('/leave-list-manager');
        hideLoader();

        let tableList = $("#tableList");
        let tableData = $("#tableData");

        tableData.DataTable().destroy();
        tableList.empty();

        response.data.forEach(function(item, index) {
            let row = `
            <tr>
               
               <td>${index+1}</td>
               <td>${item['start_date']}</td>
               <td>${item['end_date']}</td>
               <td>${item['reason']}</td>
               <td>${item['leave_category']['name']}</td>
               <td>${item['status']}</td>
              
           </tr>
            `
            tableList.append(row);
        });

        new DataTable('#tableData',{
            order:[[0,'desc']],
            lengthMenu:[5,10,15,20,30]
        });

    }

</script> --}}