
// function uniKeyCode(event) {
//         var key = event.keyCode;
//         var tamp = "";
//         if((key < 65 || key > 90) && (key != 8 && key != 46)){
//             tamp = VM.formData.username;
//             VM.formData.username = tamp.slice(0,(tamp.length-1));
//         }
//     }
function wait(ms) {
    return (x) => {
     return new Promise(resolve => setTimeout(() => resolve(x), ms));
    };
}

Vue.use(VueResource);
Vue.http.options.root='https://ifest.himaforka-uajy.org/hackfest/';
Vue.http.headers.common['Authorization'] = 'Basic aGFja2Zlc3Q6SGFja2Zlc1RASUZFU1QtdWFqeSM2';
VM = new Vue({
    delimiters: ['[[',']]'],
    el: '#app',
    data() {
        return {
            formUpdate : {
                nama_kel: "",
                asalUniv: "",
                email: "",
                idLine: "",
                noTelp: "",
            },
            formData : {
                dataKel: "",
                nama_leng: "",
                nis: null,
                vegetarian: null,
                alergi: "Tidak Ada",
            },
            formTim:{
              nama_kel:"",
              asalUniv:"",
              email:"",
              idLine:"",
              username:"",
              password:"",
              noTelp:"",
              check: 0,
              bukti: null,
              proposal: null,
            },
            formLogin : {
              username : "",
              password : "",
            },
            kelompok: [],
            peserta : [],
            kartuPelajar: null,
            button: 'Daftar Tim',
            buttonLogin: 'Masuk',
            buttonAdd: 'Tambahkan',
            type: 0,
            ermsg: null,
            toggleVege:'YES',
            uploadedFiles: [],
            uploadFieldName: null,
            uploadError: null,
            currentStatusBukti: 0,
            currentStatusProposal: 0,
            STATUS_INITIAL : 0,
            STATUS_SAVING : 1,
            STATUS_SUCCESS : 2,
            STATUS_FAILED : 3,
            passwordRetype: null,
            verif: "Verifikasi",
            files : new FormData(),
            vegetarian: 0,
        }
    },
    methods: {
//////////////

        cekTim : function(){
            if(this.formTim.nama_kel === ""){
                alert("Nama kelompok tidak boleh kosong");
                return -1;
            }
            if(this.formTim.asalUniv === ""){
                alert("Asal universitas tidak boleh kosong");
                return -1;
            }
            if(this.formTim.email === ""){
                alert("Email tidak boleh kosong");
                return -1;
            }
            if(this.formTim.idLine === ""){
                alert("Id Line tidak boleh kosong");
                return -1;
            }
            if(this.formTim.noTelp === ""){
                alert("Nomor Telepon tidak boleh kosong");
                return -1;
            }
            if(isNaN(this.formTim.noTelp)=== true){
                alert("Nomor Telepon tidak boleh mengandung karakter");
                return -1;
            }
            if(this.formTim.username === ""){
                alert("Username tidak boleh kosong");
                return -1;
            }
            var data = this.formTim.username;
            if(data.indexOf(' ') >= 0 || data.indexOf('.') >= 0 || data.indexOf('`') >= 0 || data.indexOf('-') >= 0 || data.indexOf('@') >= 0){
                alert("Username tidak boleh mengandung karakter lain selain huruf dan angka");
                return -1;
            }
            
            if(this.formTim.password === ""){
                alert("Password tidak boleh kosong");
                return -1;
            }
            if(this.formTim.password.length < 8){
                alert("Password harus lebih dari sama dengan 8 karakter");
                return -1;
            }
            if(this.formTim.password != this.passwordRetype){
                alert("Password tidak sama");
                return -1;
            }
            return 1;
        },
        cekUpdate : function(){
            if(this.formUpdate.nama_kel === ""){
                alert("Nama kelompok tidak boleh kosong");
                return -1;
            }
            if(this.formUpdate.asalUniv === ""){
                alert("Asal universitas tidak boleh kosong");
                return -1;
            }
            if(this.formUpdate.email === ""){
                alert("Email tidak boleh kosong");
                return -1;
            }
            if(this.formUpdate.idLine === ""){
                alert("Id Line tidak boleh kosong");
                return -1;
            }
            if(this.formUpdate.noTelp === ""){
                alert("Nomor Telepon tidak boleh kosong");
                return -1;
            }
            if(isNaN(this.formUpdate.noTelp)=== true){
                alert("Nomor Telepon tidak boleh mengandung karakter");
                return -1;
            }
            return 1;
        },
        cek : function(){
            if(this.formData.nama_leng === ""){
                alert("Nama tidak boleh kosong");
                return -1;
            }
            if(this.formData.nis === ""){
                alert("Nomor Mahasiswa tidak boleh kosong");
                return -1;
            }
            if(this.formData.vegetarian=== null){
                alert("vegetarian tidak boleh kosong");
                return -1;
            }
            
            return 1;

        },
        post: function(id,user){
            if(this.cek()!= 1){
                return;
            }
            
            if(this.peserta.length<5)
            {
            
                this.formData.dataKel = id;
                this.button = "Daftar...";
                this.$http.post('datapeserta/',this.formData).then(response => {
                        alert("Peserta Berhasil ditambahkan!");
                }, error=>{
                    this.buttonAdd = "Coba lagi";
                    if (error.status == 403) {
                        return alert("Forbidden Access! Silahkan coba lagi!");
                    } else if (error.status == 400) {
                        return alert("Silahkan coba lagi dengan NPM yang berbeda!");
                    }
                    
                    else if (error.status == 500) {
                        return alert("Sistem sedang down! Silahkan kembali dalam waktu beberapa saat lagi!");
                    }
                }).then(wait(2000)).then(response =>{
                      this.getInfoKelompok(user);
                  });
            }
            
            else alert("Peserta maksimal hanya 5!");

        },
        postTim: function(){
            if(this.cekTim()!= 1){
                return;
            }
            this.button = "Daftar...";
            this.$http.post('datakelompok/',this.formTim).then(response => {
                    
                    window.location.href="sukses.html";
            }, error=>{
                console.log(error);
                this.button = "Coba Lagi";
                console.log(error);
                if (error.status == 403) {
                    return alert("Forbidden Access! Silahkan coba lagi!");
                } else if (error.status == 400) {
                    if(error.body.nama_kel != null){
                        alert("Silahkan coba lagi dengan nama kelompok yang berbeda!");
                    }else if(error.body.username != null){
                        alert("Silahkan coba lagi dengan username yang berbeda!");
                    }
                    return ;
                }
                
                else if (error.status == 500) {
                    return alert("Sistem sedang down! Silahkan kembali dalam waktu beberapa saat lagi!");
                }
            });

        },
          login: function(){
            this.buttonLogin = "Masuk... ";
            this.$http.post('datakelompok/login/',this.formLogin).then(response => {
               if(response.data.token != null){
                this.$http.post('https://ifest-uajy.com/hackfest/area-peserta.php/',{ 
                    id: response.data.pk, 
                    user: response.data.username },
                    {
                    headers : { 'Content-Type': 'application/json' }
                }).then(response=>{
                    window.location.href="area-peserta.php";
                })
               }
                
            }, error=>{
                this.buttonLogin = "Coba Lagi";
                if (error.status == 403) {
                    return alert("Forbidden Access! Silahkan coba lagi!");
                } else if (error.status == 400) {
                    return alert("Bad Request Access! Silahkan coba lagi!");
                }
                
                else if (error.status == 500) {
                    return alert("Sistem sedang down! Silahkan kembali dalam waktu beberapa saat lagi!");
                }
            });

        },
        urlReturn: function(data){
            var acara
            acara = 'workshop';
            return 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='+data+'&acara='+acara+'&choe=UTF-8';
        },
        upload: function(formData, user) {
        this.$http.patch('datakelompok/'+user+'/', formData)
                .then(response => {
            return response.json();
            }, error=> {
                if (error.status == 403) {
                    return alert("Forbidden Access! Silahkan coba lagi!");
                } else if (error.status == 400) {
                    return alert("Bad Request Access! Silahkan coba lagi!");
                }
            }).then(wait(1500))
            .then(x => {
                    this.uploadedFiles = [].concat(x);
                    if(this.uploadFieldName == 'bukti'){
                      this.currentStatusBukti = this.STATUS_SUCCESS;
        
                    }else if(this.uploadFieldName == 'proposal'){
                      this.currentStatusProposal = this.STATUS_SUCCESS;
        
                    }
            })
            .catch(err => {
                alert(err);
                this.uploadError = err.response;
                if(this.uploadFieldName == 'bukti'){
                  this.currentStatusBukti = this.STATUS_FAILED;
    
                }else if(this.uploadFieldName == 'proposal'){
                  this.currentStatusProposal = this.STATUS_FAILED;
    
                }
            });
        },
  
        save(formData,user) {
            // upload data to the server
            if(this.uploadFieldName == 'bukti'){
              this.currentStatusBukti = this.STATUS_SAVING;
            }else if(this.uploadFieldName == 'proposal'){
            this.currentStatusProposal = this.STATUS_SAVING;
            }
            this.upload(formData, user);
          },
      
         filesChange: function(fieldName, fileList, user, file) {
            // handle file changes
            this.uploadFieldName = file;
            var formData = new FormData();
            if (!fileList.length) return;
            Array
              .from(Array(fileList.length).keys())
              .map(x => {
                if(file == 'proposal'){
                  formData.append('proposal',this.$refs.file.files[0]);
                }else{
                  formData.append('bukti', fileList[x], fileList[x].name);
                }
                  });
                // save it
             this.save(formData,user);
          },
        
         getInfoKelompok: function(user) {
            this.$http.get('datakelompok/'+user+'/')
                    .then(response => {
                        this.kelompok = response.body;
                        this.peserta = this.kelompok.anggota;
                        this.formUpdate.nama_kel = this.kelompok.nama_kel;
                        this.formUpdate.asalUniv = this.kelompok.asalUniv;
                        this.formUpdate.email = this.kelompok.email;
                        this.formUpdate.idLine = this.kelompok.idLine;
                        this.formUpdate.noTelp = this.kelompok.noTelp;
                        if(this.kelompok.check ==1){
                            this.currentStatusBukti = this.STATUS_SUCCESS;
                        }
                    }, error=>{
                        if (error.status == 403) {
                            return alert("Forbidden Access! Silahkan coba lagi!");
                        } else if (error.status == 400) {
                            return alert("Bad Request Access! Silahkan coba lagi!");
                        }
                    })
        },
        deleteData(id,user){
            const result = confirm("Yakin ingin menghapus data ?");
            if(result){
                this.$http.delete('datapeserta/'+id+'/?format=json')
              .then(response => {
                  alert("Berhasil di hapus");
                  
              }, error=> {
                  if (error.status == 403) {
                      return alert("Forbidden Access! Silahkan coba lagi!");
                  } else if (error.status == 400) {
                      return alert("Bad Request Access! Silahkan coba lagi!");
                  }
              }).then(wait(2000)).then(response =>{
                  this.getInfoKelompok(user);
              });
            };
            
        },
        loginSekret: function(){
            this.buttonLogin = "Masuk... ";
            console.log(this.formLogin);
            this.$http.post('https://ifest.himaforka-uajy.org/api-token-auth/',this.formLogin).then(response => {
                console.log(response);
               if(response.data.token != null && (this.formLogin.username == "ksl" || this.formLogin.username == "rigun")){
                    this.$http.post('https://ksl.himaforka-uajy.org/verifikasi.php/',{ 
                        user: this.formLogin.username },
                        {
                        headers : { 'Content-Type': 'application/json' }
                    }).then(response=>{
                        window.location.href="verifikasi.php";
                    })
               }else if(response.data.token != null && this.formLogin.username == "sekretksl"){
                   this.$http.post('https://ksl.himaforka-uajy.org/scanqrcode.php/',{ 
                        user: this.formLogin.username },
                        {
                        headers : { 'Content-Type': 'application/json' }
                    }).then(response=>{
                        window.location.href="scanqrcode.php";
                    })
                   
               }else{
                   this.buttonLogin = "Coba ganti akun :)";
               }
                
            }, error=>{
                this.buttonLogin = "Coba Lagi";
                if (error.status == 403) {
                    return alert("Forbidden Access! Silahkan coba lagi!");
                } else if (error.status == 400) {
                    return alert("Bad Request Access! Silahkan coba lagi!");
                }
                
                else if (error.status == 500) {
                    return alert("Sistem sedang down! Silahkan kembali dalam waktu beberapa saat lagi!");
                }
            });

        },
         getPeserta: function(){
                this.$http.get('datapeserta/')
                        .then(response => {
                            return response.json();
                        }, error=>{
                          if (error.status == 403) {
                              return alert("Forbidden Access! Silahkan coba lagi!");
                          } else if (error.status == 400) {
                              return alert("Bad Request Access! Silahkan coba lagi!");
                          }
                        })
                        .then(data => {
                            var resultArray = [];
                            for(let key in data.results ){
                                resultArray.push(data.results[key]);
                            }
                            this.peserta = resultArray;

                        });
            },
            updateData(user){
                if(this.cekUpdate()!= 1){
                    return;
                }
                this.$http.patch('datakelompok/'+user+'/',this.formUpdate)
                  .then(response => {
                      alert("Berhasil di Update");
                  }, error=> {
                      if (error.status == 403) {
                          return alert("Forbidden Access! Silahkan coba lagi!");
                      } else if (error.status == 400) {
                          return alert("Bad Request Access! Silahkan coba lagi!");
                      }
                  }).then(wait(2000)).then(response =>{
                      this.getInfoKelompok(user);
                  });
            }


      }
    })

