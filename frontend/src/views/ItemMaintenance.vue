<template>
  <div class="container">
    <form @submit.prevent>
      <div class="mb-3">
        <label for="codeInput" class="form-label">Code</label>
        <input
          type="number"
          class="form-control"
          id="codeInput"
          aria-describedby="itemCode"
          placeholder="Code is only in number!"
          v-model="item.code"
        />
        <div id="itemCode" class="form-text">Your Item Code.</div>
      </div>
      <div class="mb-3">
        <label for="codeInput" class="form-label">Your Item Category</label>
        <select
          class="form-select"
          aria-label="Default select example"
          v-model="item.category"
        >
          <option selected>Select your item category</option>
          <option value="F&B">Food & Beverages</option>
          <option value="Gadgets">Gadgets</option>
          <option value="Groceries">Groceries</option>
          <option value="Sports">Sports</option>
        </select>
        <div id="itemCategory" class="form-text">Your Item Category</div>
      </div>
      <div class="mb-3">
        <label for="descInput" class="form-label">Description</label>
        <input
          type="text"
          class="form-control"
          id="descInput"
          aria-describedby="itemDesc"
          placeholder="Description in text"
          v-model="item.description"
        />
        <div id="itemDesc" class="form-text">Your Item Description</div>
      </div>
      <div class="mb-3">
        <label for="priceInput" class="form-label">Your Item Price</label>
        <input
          type="number"
          class="form-control"
          id="priceInput"
          aria-describedby="itemPrice"
          min="1"
          step=".01"
          placeholder="Price in RM"
          v-model="item.price"
        />
        <div id="itemPrice" class="form-text">Your Item Price</div>
      </div>
      <button type="submit" class="btn btn-primary" @click="createItem">
        Submit
      </button>
    </form>

    <h1>Item Databases Output</h1>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Code</th>
          <th scope="col">Category</th>
          <th scope="col">Description</th>
          <th scope="col">Price</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in allData" :key="item.code">
          <th scope="row">{{ item.code }}</th>
          <td>{{ item.category }}</td>
          <td>{{ item.description }}</td>
          <td>{{ item.price }}</td>

          <button type="button" @click="deleteItem(item.code)">Delete</button>

          <!-- Button trigger modal -->
          <button
            type="button"
            data-bs-toggle="modal"
            data-bs-target="#exampleModal"
            @click="setCurrentUpdateCode(item.code)"
          >
            Update
          </button>

          <!-- Modal -->
          <div
            class="modal fade"
            id="exampleModal"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
          >
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">
                    Modal title
                  </h5>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <div class="mb-3">
                    <select
                      class="form-select"
                      aria-label="Default select example"
                      v-model="item.category"
                    >
                    <label for="codeInput" class="form-label">Your Item Category</label>
                      <option selected>Select your item category</option>
                      <option value="F&B">Food & Beverages</option>
                      <option value="Gadgets">Gadgets</option>
                      <option value="Groceries">Groceries</option>
                      <option value="Sports">Sports</option>
                    </select>
                    <div id="itemCategory" class="form-text">
                      Your Item Category
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="descInput" class="form-label"
                      >Description</label
                    >
                    <input
                      type="text"
                      class="form-control"
                      id="descInput"
                      aria-describedby="itemDesc"
                      placeholder="Description in text"
                      v-model="item.description"
                    />
                    <div id="itemDesc" class="form-text">
                      Your Item Description
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="priceInput" class="form-label"
                      >Your Item Price</label
                    >
                    <input
                      type="number"
                      class="form-control"
                      id="priceInput"
                      aria-describedby="itemPrice"
                      min="1"
                      step=".01"
                      placeholder="Price in RM"
                      v-model="item.price"
                    />
                    <div id="itemPrice" class="form-text">Your Item Price</div>
                  </div>

                  ...
                </div>
                <div class="modal-footer">
                  <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                  >
                    Close
                  </button>
                  <button type="button" class="btn btn-primary" @click="updateItem">
                    Save changes
                  </button>
                </div>
              </div>
            </div>
          </div>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import itemAPI from "@/api/itemcrudservice.js";
export default {
  data() {
    return {
      allData: undefined,
      item: {
        code: 0,
        category: "",
        description: "",
        price: 0.0,
      },
      codesDB: [],
      currentCode: 0,
    };
  },

  methods: {
    async getData() {
      let theData = await itemAPI.index();
      this.allData = theData.data;
      console.log(this.allData);
      for (let i = 0; i < theData.data.length; i++) {
        this.codesDB.push(theData.data[i].code);
      }
    },
    async createItem() {
      if (this.checkForm()) {
        await itemAPI.createItem(this.item);
        alert("Item added to the database successfully!");
        this.$router.go();
      }
    },

    async deleteItem(itemCode) {
      await itemAPI.deleteItem(itemCode);
      alert("Item successfully deleted!");
      this.$router.go();
    },

    setCurrentUpdateCode(itemCode) {
      this.currentCode = itemCode;
    },

    checkForm() {
      if (this.item.code < 0) {
        alert("Your code Item cannot be negative or have decimal");
        return false;
      } else if (this.codesDB.includes(this.item.code)) {
        alert("Your code already exist. Please enter another code!");
        return false;
      } else if (this.item.category === "") {
        alert("Your category Item cannot be empty");
        return false;
      } else if (this.item.description === "") {
        alert("Your Item Description cannot be empty");
        return false;
      } else if (this.item.price < 0) {
        alert("Your Item cannot be negative");
        return false;
      }
      return true;
    },
  },

  async mounted() {
    await this.getData();
  },
};
</script>

<style lang="scss" scoped>
</style>