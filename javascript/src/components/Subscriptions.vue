<template>
<article class="column is-8" id="subscriptions">
  <div v-if="!available && !processed" class="section content">
    <div v-html="apology_message"></div>
  </div>
  <section v-if="available && !processed">
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
              <b-select :id="slugify(production.name)" placeholder="Select a date" v-model="selected_dates[String(production.name)]" v-validate="'required'" name="selected_dates">
                <option v-for="date in production.dates" :value="production.name + ' - ' + date.value">
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
              <b-input id="number-of-seats" type="number" placeholder="0" v-model="number_of_seats" step="1" max="15" min="0" v-validate="'required'" name="number_of_seats"></b-input>
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
            <b-input type="textarea" id="special-requests" v-model="special_request"></b-input>
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
              <b-input icon="usd" id="donation-amount" type="number" v-model="donation_amount" step="1" min="0"></b-input>
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
      <h3 class="has-margin-bottom-sm">5. Payment and Contact Information</h3>

      <b-field>
        <b-select v-model="customer.subscriber_salutation">
          <option value="Mr.">Mr.</option>
          <option value="Mrs.">Mrs.</option>
          <option value="Ms.">Ms.</option>
          <option value="Dr.">Dr.</option>
          <option value="">None</option>
        </b-select>
        <b-input v-model="customer.subscriber_name" placeholder="Your full name..." name="subscriber_name"></b-input>
      </b-field>

      <b-field label="Phone Number">
        <b-input type="tel" v-model="customer.phone" placeholder="Your phone number..."></b-input>
      </b-field>

      <b-field label="Email">
        <b-input type="email" v-model="customer.email" placeholder="Your email address..."></b-input>
      </b-field>

      <h4 class="has-margin-top-lg">Billing</h4>
      <hr class="has-margin-bottom-lg" />

      <div class="columns">
        <div class="column">
          <b-field label="Billing First Name">
            <b-input v-model="customer.billing.first_name" placeholder="Your first name..."></b-input>
          </b-field>
        </div>
        <div class="column">
          <b-field label="Billing Last Name">
            <b-input v-model="customer.billing.last_name" placeholder="Your last name..."></b-input>
          </b-field>
        </div>
      </div>

      <b-field label="Billing Company">
        <b-input v-model="customer.billing.company" placeholder="Your company name..."></b-input>
      </b-field>

      <b-field label="Billing Address">
        <b-input v-model="customer.billing.address" placeholder="Your address..."></b-input>
      </b-field>

      <b-field label="Billing Address cont.">
        <b-input v-model="customer.billing.address_2" placeholder="Your address continued..."></b-input>
      </b-field>

      <div class="columns">
        <div class="column">
          <b-field label="Billing City">
            <b-input placeholder="City..." v-model="customer.billing.city"></b-input>
          </b-field>
        </div>
        <div class="column">
          <b-field label="Billing State">
            <b-select placeholder="Select a State..." v-model="customer.billing.state">
              <option v-for="state in states" :value="state">
                {{state}}
              </option>
            </b-select>
          </b-field>
        </div>
      </div>
      <div class="columns">
        <div class="column">
          <b-field label="Billing Zip">
            <b-input placeholder="Zip..." v-model="customer.billing.zip"></b-input>
          </b-field>
        </div>
        <div class="column">
          <b-field label="Billing Country">
            <b-select placeholder="Select a Country..." v-model="customer.billing.country">
              <option value="US">US</option>
              <option value="CA">CA</option>
            </b-select>
          </b-field>
        </div>
      </div>

      <h4 class="has-margin-top-lg">Shipping</h4>
      <hr class="has-margin-bottom-lg" />

      <b-switch v-model="billing_shipping_same" class="has-margin-bottom-sm">Shipping same as billing?</b-switch>

      <div class="columns">
        <div class="column">
          <b-field label="Shipping First Name">
            <b-input v-model="customer.shipping.first_name" placeholder="Your first name..." :disabled.bool="billing_shipping_same"></b-input>
          </b-field>
        </div>
        <div class="column">
          <b-field label="Shipping Last Name">
            <b-input v-model="customer.shipping.last_name" placeholder="Your last name..." :disabled.bool="billing_shipping_same"></b-input>
          </b-field>
        </div>
      </div>

      <b-field label="Shipping Company">
        <b-input v-model="customer.shipping.company" placeholder="Your company name..." :disabled.bool="billing_shipping_same"></b-input>
      </b-field>

      <b-field label="Shipping Address">
        <b-input v-model="customer.shipping.address" placeholder="Your address..." :disabled.bool="billing_shipping_same"></b-input>
      </b-field>

      <b-field label="Shipping Address cont.">
        <b-input v-model="customer.shipping.address_2" placeholder="Your address continued..." :disabled.bool="billing_shipping_same"></b-input>
      </b-field>

      <div class="columns">
        <div class="column">
          <b-field label="Shipping City">
            <b-input placeholder="City..." v-model="customer.shipping.city" :disabled.bool="billing_shipping_same"></b-input>
          </b-field>
        </div>
        <div class="column">
          <b-field label="Shipping State">
            <b-select placeholder="Select a State..." v-model="customer.shipping.state" :disabled.bool="billing_shipping_same">
              <option v-for="state in states" :value="state">
                {{state}}
              </option>
            </b-select>
          </b-field>
        </div>
      </div>
      <div class="columns">
        <div class="column">
          <b-field label="Shipping Zip">
            <b-input placeholder="Zip..." v-model="customer.shipping.zip" :disabled.bool="billing_shipping_same"></b-input>
          </b-field>
        </div>
        <div class="column">
          <b-field label="Shipping Country">
            <b-select placeholder="Select a Country..." v-model="customer.shipping.country" :disabled.bool="billing_shipping_same">
              <option value="US">US</option>
              <option value="CA">CA</option>
            </b-select>
          </b-field>
        </div>
      </div>

      <h4 class="has-margin-top-lg">Payment</h4>
      <hr class="has-margin-bottom-lg" />

      <div class="box" id="cc-info">
        <div id="card-image"></div>
        <div class="columns">
          <div class="column is-7">
            <b-input v-model="cc.number" name="number" placeholder="Card number..."></b-input>
          </div>

          <div class="column is-5">
            <b-input v-model="cc.full_name" name="name" placeholder="Name on card..."></b-input>
          </div>
        </div>
        <div class="columns">
          <div class="column is-3">
            <b-input v-model="cc.exp" name="expiry" placeholder="Expiry date..."></b-input>
          </div>

          <div class="column is-3">
            <b-input v-model="cc.cvc" name="cvc" placeholder="CVC..."></b-input>
          </div>

          <div class="column is-6">
            <button class="button is-primary" style="display: block;width: 100%;" @click="submitPayment" :disabled.bool="loading" :class="{'is-loading': loading}">Pay Now</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section v-if="processed">
    <div class="content" v-html="thank_you_message"></div>
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
import states from '~Scripts/listOfStates';
import axios from 'axios';
import Vue from 'vue';

const Card = require('card');

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
    fee_amount: String,
    authorize: Object,
    thank_you_message: String
  },
  data() {
    const selected_dates = {};
    this.productions.forEach((prod) => {
      selected_dates[`${prod.name}`] = null;
    });

    return {
      selected_dates,
      states,
      isSeatMapModalActive: false,
      isPriceZoneModalActive: false,
      seatMapUrl: null,
      number_of_seats: 0,
      donation_amount: 50.00,
      handling_fee: 0.00,
      total: 0.00,
      selected_zone: null,
      special_request: null,
      hear_about: null,
      customer: {
        phone: null,
        email: null,
        subscriber_name: null,
        subscriber_salutation: 'Mr.',
        billing: {
          first_name: null,
          last_name: null,
          company: null,
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
          company: null,
          address: null,
          address_2: null,
          city: null,
          state: null,
          zip: null,
          country: null,
        }
      },
      billing_shipping_same: true,
      cc: {
        number: null,
        full_name: null,
        exp: null,
        cvc: null
      },
      loading: false,
      processed: false,
    }
  },
  methods: {
    submitPayment() {
      this.loading = true;
      const authData = {};
      const cardData = {};

      cardData.cardNumber = this.cc.number.replace(/ /g, '');
      cardData.cardCode = this.cc.cvc;
      cardData.month = this.cc.exp.trim()
        .replace(/ /g, '')
        .split('/')[0];
      cardData.year = '20' + this.cc.exp.trim()
        .replace(/ /g, '')
        .split('/')[1];

      authData.clientKey = this.authorize.client_key;
      authData.apiLoginID = this.authorize.api_key;

      const secureData = {
        cardData,
        authData
      }

      function responseHandler(that, response) {
        if (response.messages.resultCode === "Error") {
          for (var i = 0; i < response.messages.message.length; i++) {
            console.log(response.messages.message[i].code + ": " + response.messages.message[i].text);
          }
          alert("Oops! It looks like there was an error. You were not charged for this purchase, please contact COT at (312) 704-8414 to complete your order.")
        } else {
          that.postData(response.opaqueData);
        }
      }
      Accept.dispatchData(secureData, responseHandler.bind(null, this));
    },
    postData(data) {
      const a = axios.create({
        headers: {
          'Content-Type': 'application/json'
        }
      });

      a.post('/wp-json/cot/payment-post', {
          dataDesc: data.dataDescriptor,
          dataValue: data.dataValue,
          customer: this.customer,
          total: this.total,
          details: {
            zone: this.selected_zone.label,
            request: this.special_request,
            selected_dates: this.selected_dates,
            number_of_seats: this.number_of_seats,
            donation_amount: this.donation_amount,
            hear_about: this.hear_about,
            fee: this.handling_fee,
            subtotal: this.subtotal
          }
        })
        .then((result) => {
          if (result.data.result_code === 'Ok') {
            this.processed = true;
            this.loading = false;
          } else {
            alert("Oops! It looks like there was an error. You were not charged for this purchase, please contact COT at (312) 704-8414 to complete your order.");
          }
        }, (error) => {
          alert("Oops! It looks like there was an error. You were not charged for this purchase, please contact COT at (312) 704-8414 to complete your order.");
        });
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
    },
    selected_dates_validation() {
      if (this.errors.has('selected_dates')) {
        return 'is-error';
      }
    }
  },
  watch: {
    number_of_seats() {
      if (this.has_fee) {
        this.handling_fee = this.number_of_seats * Number(this.fee_amount);
      }
      this.total = this.calc_total();
    },
    donation_amount() {
      this.total = this.calc_total();
    },
    selected_zone() {
      this.total = this.calc_total();
    },
    'customer.billing': {
      deep: true,
      handler() {
        if (this.billing_shipping_same) {
          this.customer.shipping = this.customer.billing;
        }
      }
    }
  },
  mounted() {
    let width;
    if (!this.processed) {
      const card = new Card({
        form: '#cc-info',
        container: '#card-image',
        width
      })
    }
  }
}
</script>

<style lang="scss" scoped>
.level-item {
    justify-content: left;
}
</style>

<style lang="scss">
.jp-card-container {
    @media(max-width: 420px) {
        display: none;
    }
    margin-bottom: 1.5rem !important;
}
</style>
