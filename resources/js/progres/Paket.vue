<template>
  <div class="row mt-5">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Paket</h3>
          <div class="card-tools">
            <button class="btn btn-success" @click="newModal">
              Add Paket
              <i class="fas fa-user-plus fa-fw"></i>
            </button>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-hover" id="example">
              <thead>
                <tr>
                  <th>No</th>
                  <th scope="col">Nama Paket</th>
                  <th scope="col">Pagu</th>
                  <th scope="col">Output</th>
                  <th scope="col">Satuan Output</th>
                  <th scope="col">Outcome</th>
                  <th scope="col">Satuan Outcome</th>
                  <th scope="col">Kode Pengadaan</th>
                  <th scope="col">Kode Jenis Paket</th>
                  <th scope="col">Kode Jenis Kons</th>
                  <th scope="col">Kode Output</th>
                  <th scope="col">Tahun Anggaran</th>
                  <th scope="col">Kode Satker</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="paket in paket" :key="paket.id">
                  <td scope="row">{{paket.id}}</td>
                  <td>{{paket.nmpaket}}</td>
                  <td>{{paket.pagurmp | numeral('0,0')}}</td>
                  <td>{{paket.output| numeral('0,0.00')}}</td>
                  <td>{{paket.satoutput}}</td>
                  <td>{{paket.outcome| numeral('0,0.00')}}</td>
                  <td>{{paket.satoutcome}}</td>
                  <td>{{paket.kdpengadaan}}</td>
                  <td>{{paket.kdjnspaket}}</td>
                  <td>{{paket.kdjnskon}}</td>
                  <td>{{paket.kdoutput}}</td>
                  <td>{{paket.thnanggaran}}</td>
                  <td>{{paket.kdsatker}}</td>
                  <td>
                    <a href="#" @click="editModal(paket)">
                      <i class="fa fa-edit blue"></i>
                    </a>
                    /
                    <a href="#" @click="deletePaket(paket.id)">
                      <i class="fa fa-trash red"></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="addNew"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addNewLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Tambah Paket</h5>
            <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update Paket</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editmode ? updatePaket() : createPaket()">
            <div class="modal-body">
              <div class="form-group">
                <input
                  v-model="form.nmpaket"
                  type="text"
                  name="nmpaket"
                  placeholder="Nama Paket"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('nmpaket') }"
                />
                <has-error :form="form" field="nmpaket"></has-error>
              </div>

              <div class="form-group">
                <input
                  v-model="form.pagurmp"
                  type="number"
                  name="pagurmp"
                  placeholder="Pagu"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('pagurmp') }"
                />
                <has-error :form="form" field="pagurmp"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.output"
                  type="number"
                  name="output"
                  placeholder="Output"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('output') }"
                />
                <has-error :form="form" field="output"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.satoutput"
                  type="text"
                  name="satoutput"
                  placeholder="Satuan Output"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('satoutput') }"
                />
                <has-error :form="form" field="satoutput"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.outcome"
                  type="number"
                  name="outcome"
                  placeholder="Outcome"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('outcome') }"
                />
                <has-error :form="form" field="outcome"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.satoutcome"
                  type="text"
                  name="satoutcome"
                  placeholder="Satuan Outcome"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('satoutcome') }"
                />
                <has-error :form="form" field="satoutcome"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.kdpengadaan"
                  type="text"
                  name="kdpengadaan"
                  placeholder="Kode Pengadaan"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('kdpengadaan') }"
                />
                <has-error :form="form" field="kdpengadaan"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.kdjnspaket"
                  type="text"
                  name="kdjnspaket"
                  placeholder="Kode Jenis Paket"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('kdjnspaket') }"
                />
                <has-error :form="form" field="kdjnspaket"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.kdjnskon"
                  type="text"
                  name="kdjnskon"
                  placeholder="Kode Jenis Kon"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('kdjnskon') }"
                />
                <has-error :form="form" field="kdjnskon"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.kdoutput"
                  type="text"
                  name="kdoutput"
                  placeholder="Kode Output"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('kdoutput') }"
                />
                <has-error :form="form" field="kdoutput"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.thnanggaran"
                  type="text"
                  name="thnanggaran"
                  placeholder="Tahun Anggaran"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('thnanggaran') }"
                />
                <has-error :form="form" field="thnanggaran"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.kdsatker"
                  type="text"
                  name="kdsatker"
                  placeholder="Kode Satker"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('kdsatker') }"
                />
                <has-error :form="form" field="kdsatker"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.id_note"
                  type="text"
                  name="id_note"
                  placeholder="Note"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('id_note') }"
                />
                <has-error :form="form" field="id_note"></has-error>
              </div>

              <!-- <div class="form-group">
                        <select name="type" v-model="form.type" id="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                            <option value="">Select User Role</option>
                            <option value="admin">Admin</option>
                            <option value="user">Standard User</option>
                            <option value="author">Author</option>
                        </select>
                        <has-error :form="form" field="type"></has-error>
              </div>-->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
              <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
</template>

<script>
import datatables from "datatables";
export default {
  mounted() {
    this.getPaket();
  },
  data() {
    return {
      editmode: false,
      paket: {},
      form: new Form({
        id: "",
        nmpaket: "",
        pagurmp: "",
        output: "",
        satoutput: "",
        outcome: "",
        satoutcome: "",
        kdpengadaan: "",
        kdjnspaket: "",
        kdjnskon: "",
        kdoutput: "",
        thnanggaran: "",
        kdsatker: "",
        id_note: ""
      })
    };
  },
  methods: {
    mytable() {
      $(function() {
        $("#example").DataTable();
      });
    },
    getPaket() {
      var urlPaket = "api/paket";
      axios.get(urlPaket).then(response => {
        this.paket = response.data;
        this.mytable();
      });
    },
    updatePaket() {
      this.$Progress.start();
      // console.log('Editing data');
      this.form
        .put("api/paket/" + this.form.id)
        .then(() => {
          // success
          $("#addNew").modal("hide");
          swal("Updated!", "Information has been updated.", "success");
          this.$Progress.finish();
          Fire.$emit("AfterCreate");
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    editModal(paket) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(paket);
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
    },
    deletePaket(id) {
      swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        // Send request to the server

        if (result.value) {
          this.form
            .delete("api/paket/" + id)
            .then(() => {
              swal("Deleted!", "Your file has been deleted.", "success");
              Fire.$emit("AfterCreate");
            })
            .catch(() => {
              swal("Failed!", "There was something wronge.", "warning");
            });
        }
      });
    },
    loadPaket() {
      //   if (this.$gate.isAdminOrAuthor()) {
      axios.get("api/paket").then(({ data }) => (this.paket = data));
      //   }
    },

    createPaket() {
      this.$Progress.start();
      this.form
        .post("api/paket")
        .then(() => {
          Fire.$emit("AfterCreate");
          $("#addNew").modal("hide");

          toast({
            type: "success",
            title: "Paket Created in successfully"
          });
          this.$Progress.finish();
        })
        .catch(() => {});
    }
  },
  created() {
    Fire.$on("searching", () => {
      let query = this.$parent.search;
      axios
        .get("api/findPaket?q=" + query)
        .then(data => {
          this.paket = data.data;
        })
        .catch(() => {});
    });
    this.loadPaket();
    Fire.$on("AfterCreate", () => {
      this.loadPaket();
    });
    //    setInterval(() => this.loadPaket(), 3000);
  }
};
</script>
