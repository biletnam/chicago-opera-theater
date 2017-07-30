<template>
<article class="column is-8" id="subscriptions">
  <div v-if="!available" class="section content">
    <div v-html="apology_message"></div>
  </div>
  <section v-else>
    <!-- Select Dates -->
    <div class="section">
      <h3>1. Select your performance dates</h3>
      <div class="level has-margin-top-md" v-for="production in productions">
        <div class="level-left">
          <div class="level-item">
            <p>
              <a :href="production.link"><label :for="slugify(production.name)">{{production.name}}</label></a>
              <br />
              <small>{{production.theater_name}} - <a @click.stop="activateSeatMapModal(production.seat_map)" href="#">Seat Map</a></small>
            </p>
          </div>
        </div>
        <div class="level-right">
          <div class="level-item">
            <b-field>
              <b-select :id="slugify(production.name)" placeholder="Select a date" v-model="selected_dates[String(production.name)]">
                <option v-for="date in production.dates" :value="date.value">
                  {{date.label}}
                </option>
              </b-select>
            </b-field>
          </div>
        </div>
      </div>
    </div>

    <!-- Select Seats -->
    <div class="section">
      <h3>2. Select your number of seats and preferred seating section</h3>
      <div class="level has-margin-top-md">
        <div class="level-left">
          <div class="level-item">
            <label for="number-of-seats">
              Number of Seats
            </label>
          </div>
        </div>
        <div class="level-right">
          <div class="level-item">
            <b-field>
              <b-input id="number-of-seats" type="number" placeholder="0" v-model="number_of_seats" step="1" max="15"></b-input>
            </b-field>
          </div>
        </div>
      </div>
      <div class="level has-margin-top-md">
        <div class="level-left">
          <div class="level-item">
            <a @click.stop="isPriceZoneModalActive = true" href="#">
              <label for="price-zone">
                Price Zone
              </label>
            </a>
          </div>
        </div>
        <div class="level-right">
          <div class="level-item">
            <b-field>
              <b-select id="price-zone" placeholder="Select a price zone" v-model="selected_zone">
                <option v-for="zone in price_zones" :value="zone">
                  {{zone.label}} (${{zone.value}})
                </option>
              </b-select>
            </b-field>
          </div>
        </div>
      </div>
      <div class="columns has-margin-top-md">
        <div class="column is-5">
          <label for="special-requests">
                Have a request or comment?
              </label>
        </div>
        <div class="column is-7">
          <b-field>
            <b-input type="textarea" id="special-requests" v-model="request"></b-input>
          </b-field>
        </div>
      </div>
      <div class="level has-margin-top-md">
        <div class="level-left">
          <div class="level-item">
            <label for="hear-about">
                How did you hear about us?
              </label>
          </div>
        </div>
        <div class="level-right">
          <div class="level-item">
            <b-field>
              <b-select id="hear-about" placeholder="Select an option" v-model="hear_about">
                <option v-for="option in hear_about_options" :value="option.value">
                  {{option.label}}
                </option>
              </b-select>
            </b-field>
          </div>
        </div>
      </div>
    </div>

    <div class="section">
      <h3>3. Add an optional donation amount</h3>

      <div class="level has-margin-top-md">
        <div class="level-left">
          <div class="level-item">
            <label for="donation-amount">
              Tax-deductible Donation Amount
            </label>
          </div>
        </div>
        <div class="level-right">
          <div class="level-item">
            <b-field>
              <b-input icon="usd" id="donation-amount" type="number" v-model="donation_amount" step=".01"></b-input>
            </b-field>
          </div>
        </div>
      </div>
    </div>

    <div class="section">
      <h3>4. Review Totals</h3>

      <table class="table has-margin-top-md">
        <tr>
          <td>
            <strong>Subtotal</strong>
          </td>
          <td>
            {{monify(subtotal)}}
          </td>
        </tr>
        <tr>
          <td>
            <strong>Donation Amount</strong>
          </td>
          <td>
            {{monify(donation_amount)}}
          </td>
        </tr>
        <tr v-if="has_fee">
          <td>
            <strong>Handling Fee ($6 per subscription)</strong>
          </td>
          <td>
            {{monify(handling_fee)}}
          </td>
        </tr>
        <tr class="is-selected">
          <td>
            <strong>Total</strong>
          </td>
          <td>
            <strong>{{monify(total)}}</strong>
          </td>
        </tr>
      </table>
    </div>

    <div class="section">
      <h3>5. Payment and Contact Information</h3>

      <b-field label="Subscription Holder">
        <b-input v-model="customer.first_name" placeholder="Your first name..."></b-input>
      </b-field>

      <iframe id="load_payment" name="load_payment">
      </iframe>
      <form action="https://test.authorize.net/payment/payment" id="cc-form" target="load_payment" method="post">
        <input type="hidden" :value="token" name="token" />
      </form>
      <button class="button is-primary" @click="activateForm">Checkout</button>
    </div>
  </section>

  <b-modal :active.sync="isSeatMapModalActive" :width="640">
    <p class="image is-4by3">
      <img :src="seatMapUrl">
    </p>
  </b-modal>

  <b-modal :active.sync="isPriceZoneModalActive" :width="640">
    <div class="box">
      <div class="card">
        <div class="card-header">
          <h4 class="card-header-title">Price Zones</h4>
        </div>
        <div class="card-content">
          <table class="table is-striped is-bordered">
            <thead>
              <th>
                Zone
              </th>
              <th>
                Price
              </th>
            </thead>
            <tbody>
              <tr v-for="zone in price_zones">
                <td>
                  {{zone.label}}
                </td>
                <td>
                  ${{zone.value}}
                </td>
              </tr>
            </tbody>
          </table>
          <div v-for="zone in price_zone_images">
            <h4>{{zone.name}}</h4>
            <p class="image is-4by3" v-for>
              <img :src="zone.image">
            </p>
          </div>
        </div>
      </div>
    </div>
  </b-modal>
</article>
</template>

<script>
import formatMoney from '~Scripts/formatMoney';
import axios from 'axios';
import Vue from 'vue';
export default {
  name: 'Subscriptions',
  props: {
    available: {
      type: Boolean,
      default: false
    },
    apology_message: String,
    productions: Array,
    price_zones: Array,
    price_zone_images: Array,
    hear_about_options: Array,
    has_fee: {
      type: Boolean,
      default: false
    },
    fee_amount: Number,
  },
  data() {
    const selected_dates = {};
    this.productions.forEach((prod) => {
      selected_dates[`${prod.name}`] = null;
    });

    return {
      selected_dates,
      isSeatMapModalActive: false,
      isPriceZoneModalActive: false,
      seatMapUrl: null,
      number_of_seats: 0,
      donation_amount: 50.00,
      handling_fee: 0.00,
      total: 0.00,
      selected_zone: null,
      request: null,
      hear_about: null,
      customer: {
        phone: null,
        email: null,
        billing: {
          first_name: null,
          last_name: null,
          address: null,
          address_2: null,
          city: null,
          state: null,
          zip: null,
          country: null,
        },
        shipping: {
          first_name: null,
          last_name: null,
          address: null,
          address_2: null,
          city: null,
          state: null,
          zip: null,
          country: null,
        }
      },
      token: null
    }
  },
  methods: {
    activateForm() {
      const a = axios.create({
        headers: {
          'Content-Type': 'application/json'
        }
      });
      a.post('/wp-json/cot/form-token', {
          cost: String(12),
          customer: {
            first_name: 'Joshua',
            email: 'joshua.r.bartlett@gmail.com'
          }
        })
        .then((response) => {
          console.log(response.data);
          this.token = response.data.token;
          Vue.nextTick(() => {
            document.getElementById('cc-form')
              .submit();
          })
        })
    },
    activateSeatMapModal(url) {
      this.seatMapUrl = url;
      this.isSeatMapModalActive = true;
    },
    slugify(name) {
      return name.toLowerCase()
        .replace(' ', '-');
    },
    calc_total() {
      let subtotal = Number(this.subtotal) + Number(this.donation_amount);
      if (this.has_fee) {
        subtotal += Number(this.handling_fee)
      }
      return subtotal;
    },
    monify(number) {
      return formatMoney(number);
    }
  },
  computed: {
    subtotal() {
      if (!this.selected_zone) {
        return 0.00
      } else {
        return this.selected_zone.value * this.number_of_seats
      }
    }
  },
  watch: {
    number_of_seats() {
      this.handling_fee = this.number_of_seats * Number(this.fee_amount);
      this.total = this.calc_total();
    },
    donation_amount() {
      this.total = this.calc_total();
    },
    selected_zone() {
      this.total = this.calc_total();
    }
  }
}
</script>

<style lang="scss" scoped>
.level-item {
    justify-content: left;
}

iframe {
    width: 100%;
    height: 700px;
}
</style>
