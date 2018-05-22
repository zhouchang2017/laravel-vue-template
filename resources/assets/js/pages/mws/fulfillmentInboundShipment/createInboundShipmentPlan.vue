<template>
    <v-card>
        <v-card-title primary-title class="grey lighten-4">
            <h3 class="headline mb-0">{{ $options.name }}</h3>
        </v-card-title>
        <v-divider></v-divider>
        <v-form v-model="valid" ref="form" lazy-validation>
            <v-card>
                <v-card-title primary-title>
                    <div>
                        <div class="headline">ShipFromAddress</div>
                        <span class="grey--text">邮寄地址信息</span>
                    </div>
                </v-card-title>
                <v-card-text>
                    <v-text-field
                            label="Name"
                            v-model="formData.address.name"
                            :rules="[()=>!!formData.address.name || 'name is required!!']"
                            :counter="50"
                            hint="名称或公司名称"
                            persistent-hint
                            required
                    ></v-text-field>

                    <v-text-field
                            label="AddressLine1"
                            v-model="formData.address.addressLine1"
                            :rules="[()=>!!formData.address.addressLine1 || 'addressLine1 is required!!']"
                            :counter="180"
                            hint="街道地址信息"
                            persistent-hint
                            required
                    ></v-text-field>

                    <v-text-field
                            label="AddressLine2"
                            v-model="formData.address.addressLine2"
                            :rules="[()=>formData.address.addressLine2.length>60 || 'addressLine2 max length 60!!']"
                            :counter="60"
                            hint="其他街道地址信息（如果需要）"
                            persistent-hint
                    ></v-text-field>

                    <v-text-field
                            label="City"
                            v-model="formData.address.city"
                            :rules="[()=>!!formData.address.city || 'city is required!!']"
                            :counter="30"
                            hint="城市"
                            persistent-hint
                            required
                    ></v-text-field>

                    <v-text-field
                            label="DistrictOrCounty"
                            v-model="formData.address.districtOrCounty"
                            :counter="25"
                            hint="区或县"
                            persistent-hint
                    ></v-text-field>

                    <v-text-field
                            label="StateOrProvinceCode"
                            v-model="formData.address.stateOrProvinceCode"
                            :counter="2"
                            hint="省/自治区/直辖市代码"
                            persistent-hint
                    ></v-text-field>

                    <v-text-field
                            label="CountryCode"
                            v-model="formData.address.countryCode"
                            :rules="[()=>!!formData.address.countryCode || 'CountryCode is required!!']"
                            :counter="2"
                            hint="国家/地区代码"
                            persistent-hint
                            required
                    ></v-text-field>

                    <v-text-field
                            label="PostalCode"
                            v-model="formData.address.postalCode"
                            :counter="30"
                            hint="邮政编码"
                            persistent-hint
                    ></v-text-field>

                </v-card-text>
            </v-card>
            <v-card>
                <v-card-title primary-title>
                    <div>
                        <div class="headline">LabelPrepPreference</div>
                        <span class="grey--text">您对入库货件标签准备的选项设置</span>
                    </div>
                </v-card-title>
                <v-card-text>
                    <v-select
                            clearable
                            hint="您对入库货件标签准备的选项设置"
                            label="LabelPrepPreference"
                            item-text="desc"
                            item-value="val"
                            autocomplete
                            cache-items
                            chips
                            :items="labelPrepPreference"
                            v-model="formData.labelPrepPreference"
                    ></v-select>
                </v-card-text>
            </v-card>

            <v-card>
                <v-card-title primary-title>
                    <div>
                        <div class="headline">InboundShipmentPlanRequestItems</div>
                        <span class="grey--text">入库货件中各商品的 SKU 和数量信息</span>
                    </div>
                </v-card-title>
                <v-card-text>

                    <v-card class="my-3" v-for="(item,index) in formData.inboundShipmentPlanRequestItems" :key="index">

                        <v-card-title primary-title>
                            <div>
                                <div class="title">{{ `InboundShipmentPlanRequestItem ${index+1}` }}</div>
                                <span class="grey--text">商品的 SKU 和数量信息</span>
                            </div>
                        </v-card-title>
                        <v-card-text>
                            <v-text-field
                                    label="SellerSKU"
                                    v-model="item.sellerSKU"
                                    :rules="[()=>!!item.sellerSKU || 'sellerSKU is required!!']"
                                    :counter="200"
                                    hint="商品的卖家 SKU"
                                    persistent-hint
                                    required
                            ></v-text-field>

                            <v-text-field
                                    label="ASIN"
                                    v-model="item.asin"
                                    hint="商品的亚马逊标准识别号 (ASIN)"
                                    persistent-hint
                            ></v-text-field>

                            <v-select
                                    clearable
                                    hint="商品的状况"
                                    label="Condition"

                                    autocomplete
                                    cache-items
                                    chips
                                    :items="condition"
                                    v-model="item.condition"
                            ></v-select>

                            <v-text-field
                                    label="Quantity"
                                    v-model="item.quantity"
                                    :rules="[() => /^\d+$/.test(item.quantity) || 'This field is must be unsignedInteger']"
                                    hint="商品数量"
                                    persistent-hint
                                    required
                            ></v-text-field>

                            <v-text-field
                                    label="QuantityInCase"
                                    v-model="item.quantityInCase"
                                    :rules="[() => /^\d+$/.test(item.quantityInCase) || 'This field is must be unsignedInteger']"
                                    hint="每个包装箱中的商品数量（仅针对原厂包装发货商品）。请注意，QuantityInCase x 入库货件中的包装箱数 = Quantity。另请注意，入库货件中的所有包装箱必须是原厂包装发货或者混装发货。因此，当您提交 CreateInboundShipmentPlan 操作时，必须对货件中的每件商品提供 QuantityInCase 的值，或者都不提供"
                                    persistent-hint
                            ></v-text-field>
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>

                            <v-btn color="primary"  flat @click="del(index)">remove</v-btn>
                        </v-card-actions>

                    </v-card>
                    <v-btn small @click="add">Add InboundShipmentPlanRequestItem</v-btn>
                </v-card-text>

                <v-divider class="mt-5"></v-divider>
                <v-card-actions>
                    <v-btn flat @click="resetForm">Clear</v-btn>
                    <v-spacer></v-spacer>

                    <v-btn color="primary" :disabled="!valid" flat @click="submit">Submit</v-btn>
                </v-card-actions>

            </v-card>
        </v-form>
    </v-card>
</template>

<script>
  export default {
    name: 'CreateInboundShipmentPlan',
    data(){
      return {
        valid:true,
        labelPrepPreference:[
          {val:'SELLER_LABEL',desc:'如需要标签，则卖家将为入库货件的商品贴标'},
          {val:'AMAZON_LABEL_ONLY',desc:'如需要标签，则亚马逊将尝试为入库货件的商品贴标。如果亚马逊确定其不具备为商品成功贴标所需的信息，则入库货件计划中不包括该商品'},
          {val:'AMAZON_LABEL_PREFERRED',desc:'如需要标签，则亚马逊将尝试为入库货件的商品贴标。如果亚马逊确定其不具备为商品成功贴标所需的信息，则入库货件计划中包括该商品且卖家必须为其贴标'},
        ],
        condition:[
          'NewItem','NewWithWarranty','NewOEM','NewOpenBox','UsedLikeNew','UsedVeryGood','UsedGood','UsedAcceptable','UsedPoor',
          'UsedRefurbished','CollectibleLikeNew','CollectibleVeryGood','CollectibleGood','CollectibleAcceptable','CollectiblePoor',
          'RefurbishedWithWarranty','Refurbished','Club'
        ],
        formData:{
          address:{
            name:'',
            addressLine1:'',
            addressLine2:'',
            city:'',
            districtOrCounty:'',
            stateOrProvinceCode:'',
            countryCode:'',
            postalCode:''
          },
          labelPrepPreference:'',
          inboundShipmentPlanRequestItems:[

          ]
        }
      }
    },
    methods:{
      add(){
        this.formData.inboundShipmentPlanRequestItems.push({
          sellerSKU:'',
          asin:'',
          condition:'',
          quantity:'',
          quantityInCase:''
        })
      },
      del(index){
        this.formData.inboundShipmentPlanRequestItems.splice(index,1)
      },
      resetForm () {
        this.errorMessages = []
        this.formHasErrors = false
        this.$refs.form.reset()
      },
      async submit () {
        if (this.$refs.form.validate()) {
          // Native form submission is not yet supported
          // await this.$store.dispatch('post/store', {formDate: this.formDate})
          this.$store.dispatch('message/responseMessage', {
            text: JSON.stringify(this.formData)
          })
          // this.$router.replace({name: 'post.index'})
        }
      },
    },
    created(){
      this.add()
    }
  }
</script>

<style scoped>

</style>