<html>
    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div id="app">
            <div class="container">
                <div style="margin-top:20px;" class="row">
                    <div class="col-sm">
                        <h2>@{{message}}</h2>
                    </div>

                    <div class="col-sm-6">
                        <p @click="create()" data-toggle="modal" data-target="#exampleModal"  class="float-right btn btn-success">
                            Add New
                        </p>
                    </div>
                </div>
                <p style="color:red;">@{{returnMessage}}</p>            
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for='row in data'>
                            <td>@{{row.name}}</td>
                            <td>@{{row.mobile}}</td>
                            <td>@{{row.address}}</td>
                            <td>@{{row.email}}</td>
                            <td>
                                <a class="btn btn-success" @click="edit(row)">Edit</a>
                                <a class="btn btn-danger" @click="deleteRecord(row)">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">@{{isInsert?'New Record':'Edit Record'}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="Post">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Name:</label>
                                        <input type="text" class="form-control" v-model="Biodata.name" name="name" id="recipient-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Mobile:</label>
                                        <input type="text" class="form-control" v-model="Biodata.mobile" name="mobile" id="recipient-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Email:</label>
                                        <input type="text" class="form-control" v-model="Biodata.email"  name="email" id="recipient-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">Message:</label>
                                        <textarea class="form-control" v-model="Biodata.address" name="address" id="message-text"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" v-if="isInsert" @click="store(Biodata)" class="btn btn-primary">Save</button>
                                <button type="button" v-if="!isInsert"  @click="update(Biodata)" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/vue"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
        <script>
var csrfToken = '{{csrf_token()}}';
var adminUrl = '{{url('')}}';
new Vue({
    el: '#app',
    data: {
        returnMessage:null,
        message: 'This IS Biodata',
        isInsert:true,
        data: [],
        Biodata:{name:null,email:null,address:null,phone:null}
    },
    created: function () {
        this.init(); 
    },
    methods: {
        init: function () {
          this.$http.get('biodata')
                .then(function (res) {
                    this.data = res.data;
                });  
        },
        create: function () {
            this.isInsert = true;
            this.Biodata = {},
            $('#exampleModal').modal();
        },
        store: function (data){
           if(!confirm('Are you sure')) return;
           data._token = csrfToken;
           this.$http.post('biodatastore',data)
           .then(function (res) {
               this.returnMessage = res.data.message;
               this.init();
                $('#exampleModal').modal('hide');
                this.Biodata = {};
            });
        },
        
        
        edit: function (row) {
            $('#exampleModal').modal();
            this.Biodata = row;
            this.isInsert=false;
        },
        update: function (data) {
           if(!confirm('Are you sure')) return;
           data._token = csrfToken;
           this.$http.post('biodataupdate',data)
           .then(function (res) {
               this.returnMessage = res.data.message;
               this.init();
                $('#exampleModal').modal('hide');
                this.Biodata = {};
            }); 
        },
        
        
        deleteRecord: function (row) {
           if(!confirm('Are you sure')) return;
           row._token = csrfToken;
           this.$http.post('biodatadelette',row)
           .then(function (res) {
               this.returnMessage = res.data.message;
               this.init();
            }); 
        }
    }
});
        </script>
    </body>
</html>