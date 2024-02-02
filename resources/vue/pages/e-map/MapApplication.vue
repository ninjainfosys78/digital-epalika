<template>
    <form @submit.prevent="registerApplication">
        <div class="row mb-3">
            <div class="col-md-4">
                <VMultiSelect
                    id="organization_id"
                    v-model="form.organization_id"
                    label="संस्था"
                    name-prop="org_name_ne"
                    :options="eMapSetting?.organizations??[]"
                    @validate="validateField('organization_id')"
                    :error="errors.organization_id"
                />
            </div>
            <div class="col-md-4">
                <VMultiSelect
                    id="application_type"
                    v-model="form.application_type"
                    value-prop="value"
                    name-prop="label"
                    label="नक्सा"
                    :options="eMapSetting?.applicationForms??[]"
                    @validate="validateField('application_type')"
                    :error="errors.application_type"
                />
            </div>
        </div>
        <div class="card p-4 mb-4">
            <legend>
                <h5>१. प्रस्तावित भवनको विवरण</h5>
            </legend>
            <div class="mb-3">
                <label class="form-label fw-bolder">१.१ निर्माण कार्यको किसिम *</label>
                <div class="col">
                    <div v-for="type in eMapSetting?.constructionTypes??[]" class="form-check form-check-inline">
                        <input class="form-check-input" type="radio"
                               @change="validateField('construction_type')"
                               v-model="form.construction_type"
                               :id="type.value" :value="type.value">
                        <label class="form-check-label"
                               :for="type.value">
                            {{type.label}}
                        </label>
                    </div>
                </div>
                <p v-if="errors.construction_type" class="text-danger">
                    {{errors.construction_type}}
                </p>
            </div>
            <div class="mb-1">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <VInput
                            input-type="number"
                            id="current_storey"
                            v-model="form.current_storey"
                            placeholder="हाल निर्माण गर्ने तल्ला संख्या"
                            label="१.२ हाल निर्माण गर्ने तल्ला संख्या"
                            @validate="validateField('current_storey')"
                            :error="errors.current_storey"
                        />
                    </div>

                    <div class="col-md-3 mb-3">
                        <VInput
                            input-type="number"
                            id="future_storey"
                            v-model="form.future_storey"
                            placeholder="भविष्यमा निर्माण गर्ने तल्ला संख्या"
                            label="१.३ भविष्यमा निर्माण गर्ने तल्ला संख्या"
                            @validate="validateField('future_storey')"
                            :error="errors.future_storey"
                        />
                    </div>

                    <div class="col-md-3 mb-3">
                        <VInput
                            input-type="number"
                            id="latitude"
                            v-model="form.latitude"
                            placeholder="Latitude"
                            label="१.४ Latitude"
                            @validate="validateField('latitude')"
                            :error="errors.latitude"
                        />
                    </div>

                    <div class="col-md-3 mb-3">
                        <VInput
                            input-type="number"
                            id="longitude"
                            v-model="form.longitude"
                            placeholder="Longitude"
                            label="१.५ Longitude"
                            @validate="validateField('longitude')"
                            :error="errors.longitude"
                        />
                    </div>
                </div>
            </div>
        </div>

        <div class="card p-4 mb-4">
            <legend>
                <h5>२. जग्गाको विवरण</h5>
            </legend>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <VInput
                        input-type="number"
                        v-model="form.landDetail.ward_no"
                        label="२.१ वडा नं"
                        placeholder="वडा नं"
                        @validate="validateField('landDetail.ward_no')"
                        :error="errors['landDetail.ward_no']"
                    />
                </div>

                <div class="col-md-4 mb-3">
                    <VInput
                        input-type="number"
                        v-model="form.landDetail.former_ward_no"
                        label="२.२ साविक वडा नं"
                        placeholder="साविक वडा नं"
                        @validate="validateField('landDetail.former_ward_no')"
                        :error="errors['landDetail.former_ward_no']"
                    />
                </div>

                <div class="col-md-4 mb-3">
                    <VInput
                        v-model="form.landDetail.tole"
                        label="२.३ टोलको नाम"
                        placeholder="टोलको नाम"
                        @validate="validateField('landDetail.tole')"
                        :error="errors['landDetail.tole']"
                    />
                </div>

                <div class="col-md-4 mb-3">
                    <VInput
                        id="plot_no"
                        v-model="form.landDetail.plot_no"
                        label="२.४ जग्गा कित्ता नं"
                        placeholder="जग्गा कित्ता नं"
                        @validate="validateField('landDetail.plot_no')"
                        :error="errors['landDetail.plot_no']"
                    />
                </div>

                <div class="col-md-4 mb-3">
                    <VInput
                        id="unit_value"
                        v-model="form.landDetail.unit_value"
                        :label="`क्षेत्रफल (${eMapSetting?.setting?.standard_land_measurement??''})`"
                        placeholder="क्षेत्रफल"
                        @validate="validateField('landDetail.unit_value')"
                        :error="errors['landDetail.unit_value']"
                    />
                </div>
            </div>
        </div>

        <div class="card p-4 mb-4">
            <legend>
                <h5>३. जग्गा धनीको विवरण</h5>
            </legend>
            <div class="mb-3">
                <label class="form-label fw-bolder">३.१ जग्गा धनीको किसिम <span class="text-danger">*</span></label>
                <div class="col">
                    <div v-for="ownerType in eMapSetting?.ownerTypes??[]" class="form-check form-check-inline">
                        <input type="radio" class="form-check-input"
                               :id="ownerType.value"
                               v-model="form.landOwner.land_owner_type"
                               @change="validateField('landOwner.land_owner_type')"
                               :value="ownerType.value">
                        <label class="form-check-label"
                               :for="ownerType.value">
                            {{ownerType.label}}
                        </label>
                    </div>
                </div>
                <p v-if="errors['landOwner.land_owner_type']" class="text-danger">
                    {{errors['landOwner.land_owner_type']}}
                </p>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <VInput
                        id="landowner-name"
                        v-model="form.landOwner.name"
                        label="जग्गा धनीको नाम"
                        @validate="validateField('landOwner.name')"
                        :error="errors['landOwner.name']"
                    />
                </div>
                <div class="col-md-4 mb-3">
                    <VInput
                        id="landowner-phone"
                        v-model="form.landOwner.phone"
                        label="फोन नं."
                        @validate="validateField('landOwner.phone')"
                        :error="errors['landOwner.phone']"
                    />
                </div>
                <div class="col-md-4 mb-3">
                    <VInput
                        id="landowner-father-name"
                        v-model="form.landOwner.father_name"
                        label="बुवाको नाम"
                        @validate="validateField('landOwner.father_name')"
                        :error="errors['landOwner.father_name']"
                    />
                </div>
                <div class="col-md-4 mb-3">
                    <VInput
                        id="landowner-grandfather-name"
                        v-model="form.landOwner.grandfather_name"
                        label="हजुरबुबाको नाम"
                        @validate="validateField('landOwner.grandfather_name')"
                        :error="errors['landOwner.grandfather_name']"
                    />
                </div>
                <div class="col-md-4 mb-3">
                    <VInput
                        id="landowner-citizenship_no"
                        v-model="form.landOwner.citizenship_no"
                        label="नागरिकता नम्बर"
                        @validate="validateField('landOwner.citizenship_no')"
                        :error="errors['landOwner.citizenship_no']"
                    />
                </div>
                <div class="col-md-4 mb-3">
                    <VNepaliDatePicker
                        id="landowner-citizenship_issue_date"
                        v-model="form.landOwner.citizenship_issue_date"
                        label="नागरिकता लिएको मिति"
                        @validate="validateField('landOwner.citizenship_issue_date')"
                        :error="errors['landOwner.citizenship_issue_date']"
                    />
                </div>
                <div class="col-md-4 mb-3">
                    <VMultiSelect
                        id="landowner-citizenship_issue_district_id"
                        v-model="form.landOwner.citizenship_issue_district_id"
                        :options="eMapSetting?.allDistricts??[]"
                        name-prop="district"
                        label="नागरिकता लिएको जिल्ला"
                        @validate="validateField('landOwner.citizenship_issue_district_id')"
                        :error="errors['landOwner.citizenship_issue_district_id']"
                    />
                </div>
                <div class="col-md-4 mb-3">
                    <VInput
                        id="landowner-address"
                        v-model="form.landOwner.address"
                        label="ठेगाना"
                        @validate="validateField('landOwner.address')"
                        :error="errors['landOwner.address']"
                    />
                </div>
                <div class="col-md-4 mb-3">
                    <VInput
                        id="landowner-local_body"
                        v-model="form.landOwner.local_body"
                        label="पालिका"
                        @validate="validateField('landOwner.local_body')"
                        :error="errors['landOwner.local_body']"
                    />
                </div>
                <div class="col-md-4 mb-3">
                    <VInput
                        input-type="number"
                        id="landowner-ward_no"
                        v-model="form.landOwner.ward_no"
                        label="वडा नं."
                        @validate="validateField('landOwner.ward_no')"
                        :error="errors['landOwner.ward_no']"
                    />
                </div>
            </div>
        </div>

        <div class="card p-4 mb-4">
            <legend>
                <h5>४. घर धनीको विवरण (जग्गाधनी भन्दा फरक भएमा)</h5>
            </legend>
            <div class="d-flex align-items-center gap-2 mb-3">
                <label for="detail_check">के घर धनीको विवरण र जग्गाधनीको विवरण एउटै हो ?</label>
                <button type="button" @click.prevent="house_owner_as_land_owner=!house_owner_as_land_owner" class="btn btn-link btn-sm border-none"
                        id="detail_check">
                    <i :class="'fa fa-2x fa-toggle-'+(house_owner_as_land_owner ? 'on' : 'off')"></i>
                </button>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <VInput
                        id="houseOwner-name"
                        v-model="form.houseOwner.name"
                        label="घर धनीको नाम"
                        :disabled="house_owner_as_land_owner"
                        @validate="validateField('houseOwner.name')"
                        :error="errors['houseOwner.name']"
                    />
                </div>
                <div class="col-md-4 mb-3">
                    <VInput
                        id="houseOwner-phone"
                        v-model="form.houseOwner.phone"
                        label="फोन नं."
                        :disabled="house_owner_as_land_owner"
                        @validate="validateField('houseOwner.phone')"
                        :error="errors['houseOwner.phone']"
                    />
                </div>
                <div class="col-md-4 mb-3">
                    <VInput
                        id="houseOwner-father_name"
                        v-model="form.houseOwner.father_name"
                        label="बुवाको नाम"
                        :disabled="house_owner_as_land_owner"
                        @validate="validateField('houseOwner.father_name')"
                        :error="errors['houseOwner.father_name']"
                    />
                </div>
                <div class="col-md-4 mb-3">
                    <VInput
                        id="houseOwner-grandfather_name"
                        v-model="form.houseOwner.grandfather_name"
                        label="हजुरबुबाको नाम"
                        :disabled="house_owner_as_land_owner"
                        @validate="validateField('houseOwner.grandfather_name')"
                        :error="errors['houseOwner.grandfather_name']"
                    />
                </div>
                <div class="col-md-4 mb-3">
                    <VInput
                        id="houseOwner-citizenship_no"
                        v-model="form.houseOwner.citizenship_no"
                        label="नागरिकता नम्बर"
                        :disabled="house_owner_as_land_owner"
                        @validate="validateField('houseOwner.citizenship_no')"
                        :error="errors['houseOwner.citizenship_no']"
                    />
                </div>
                <div class="col-md-4 mb-3">
                    <VNepaliDatePicker
                        id="houseOwner-citizenship_issue_date"
                        v-model="form.houseOwner.citizenship_issue_date"
                        label="नागरिकता लिएको मिति"
                        :disabled="house_owner_as_land_owner"
                        @validate="validateField('houseOwner.citizenship_issue_date')"
                        :error="errors['houseOwner.citizenship_issue_date']"
                    />
                </div>
                <div class="col-md-4 mb-3">
                    <VMultiSelect
                        id="houseOwner-citizenship_issue_district_id"
                        v-model="form.houseOwner.citizenship_issue_district_id"
                        :options="eMapSetting?.allDistricts??[]"
                        name-prop="district"
                        label="नागरिकता लिएको जिल्ला"
                        :disabled="house_owner_as_land_owner"
                        @validate="validateField('houseOwner.citizenship_issue_district_id')"
                        :error="errors['houseOwner.citizenship_issue_district_id']"
                    />
                </div>
                <div class="col-md-4 mb-3">
                    <VInput
                        id="houseOwner-address"
                        v-model="form.houseOwner.address"
                        label="ठेगाना"
                        :disabled="house_owner_as_land_owner"
                        @validate="validateField('houseOwner.address')"
                        :error="errors['houseOwner.address']"
                    />
                </div>
                <div class="col-md-4 mb-3">
                    <VInput
                        id="houseOwner-local_body"
                        v-model="form.houseOwner.local_body"
                        label="पालिका"
                        :disabled="house_owner_as_land_owner"
                        @validate="validateField('houseOwner.local_body')"
                        :error="errors['houseOwner.local_body']"
                    />
                </div>
                <div class="col-md-4 mb-3">
                    <VInput
                        input-type="number"
                        id="houseOwner-ward_no"
                        v-model="form.houseOwner.ward_no"
                        label="वडा नं."
                        :disabled="house_owner_as_land_owner"
                        @validate="validateField('houseOwner.ward_no')"
                        :error="errors['houseOwner.ward_no']"
                    />
                </div>
            </div>
        </div>

        <div class="card p-4 mb-4">
            <legend>
                <h5>५. निवेदकको विवरण</h5>
            </legend>
            <div class="mb-3">
                <label class="form-label fw-bolder">५.१ निवेदकको प्रकार </label>
                <div class="col">
                    <div v-for="type in eMapSetting?.applicantTypes??[]" class="form-check form-check-inline">
                        <input type="radio" :id="type.value"
                               v-model="form.applicantDetail.applicant_type"
                               :value="type.value"
                               @change="validateField('applicantDetail.applicant_type')"
                               class="form-check-input">
                        <label class="form-check-label" :for="type.value">{{ type.label }}</label>
                    </div>
                </div>
                <p v-if="errors['applicantDetail.applicant_type']" class="text-danger">
                    {{errors['applicantDetail.applicant_type']}}
                </p>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bolder">५.२ घरधनी सँगको सम्बन्ध</label>
                <div class="col">
                    <div v-for="relation in eMapSetting?.relation_with_owner??[]" class="form-check form-check-inline">
                        <input type="radio" :id="relation.value"
                               v-model="form.applicantDetail.relation_with_owner"
                               :value="relation.value"
                               @change="validateField('applicantDetail.relation_with_owner')"
                               class="form-check-input">
                        <label class="form-check-label" :for="relation.value">{{ relation.label }}</label>
                    </div>
                </div>
                <p v-if="errors['applicantDetail.relation_with_owner']" class="text-danger">
                    {{errors['applicantDetail.relation_with_owner']}}
                </p>
            </div>
            <div class="row">
                <label class="form-label fw-bolder">जग्गाधनी वा घरधनी भन्दा फरक भएमा</label>
                <div class="col-md-4 mb-3">
                    <VInput
                        id="applicant-name"
                        v-model="form.applicantDetail.name"
                        label="नाम"
                        :disabled="isApplicantSame"
                        @validate="validateField('applicantDetail.name')"
                        :error="errors['applicantDetail.name']"
                    />
                </div>
                <div class="col-md-4 mb-3">
                    <VInput
                        id="applicant-phone"
                        v-model="form.applicantDetail.phone"
                        label="फोन नं."
                        :disabled="isApplicantSame"
                        @validate="validateField('applicantDetail.phone')"
                        :error="errors['applicantDetail.phone']"
                    />
                </div>
                <div class="col-md-4 mb-3">
                    <VInput
                        id="applicant-father_name"
                        v-model="form.applicantDetail.father_name"
                        label="बुवाको नाम"
                        :disabled="isApplicantSame"
                        @validate="validateField('applicantDetail.father_name')"
                        :error="errors['applicantDetail.father_name']"
                    />
                </div>
                <div class="col-md-4 mb-3">
                    <VInput
                        id="applicant-citizenship_no"
                        v-model="form.applicantDetail.citizenship_no"
                        label="नागरिकता नम्बर"
                        :disabled="isApplicantSame"
                        @validate="validateField('applicantDetail.citizenship_no')"
                        :error="errors['applicantDetail.citizenship_no']"
                    />
                </div>
                <div class="col-md-4 mb-3">
                    <VNepaliDatePicker
                        id="applicant-citizenship_issue_date"
                        v-model="form.applicantDetail.citizenship_issue_date"
                        label="नागरिकता लिएको मिति"
                        :disabled="isApplicantSame"
                        @validate="validateField('applicantDetail.citizenship_issue_date')"
                        :error="errors['applicantDetail.citizenship_issue_date']"
                    />
                </div>
                <div class="col-md-4 mb-3">
                    <VMultiSelect
                        id="applicant-citizenship_issue_district_id"
                        v-model="form.applicantDetail.citizenship_issue_district_id"
                        :options="eMapSetting?.allDistricts??[]"
                        name-prop="district"
                        label="नागरिकता लिएको जिल्ला"
                        :disabled="isApplicantSame"
                        @validate="validateField('applicantDetail.citizenship_issue_district_id')"
                        :error="errors['applicantDetail.citizenship_issue_district_id']"
                    />
                </div>
            </div>

        </div>

        <div class="d-flex justify-content-between mt-3">
            <div class="col-3">
                <VNepaliDatePicker
                    id="application_date"
                    v-model="form.applicantDetail.application_date"
                    label="निबेदनको मिति"
                    @validate="validateField('applicantDetail.application_date')"
                    :error="errors['applicantDetail.application_date']"
                />
            </div>
            <div class="col-3">
                <label class="form-label fw-bolder" for="applicant_signature">निवेदकको सहि</label>
                <input type="file" id="applicant_signature"
                       class="form-control form-control-sm">
            </div>
        </div>
        <div class="mt-4 d-flex justify-content-end">
            <VButton
                :loading="isSubmitting"
                btn-label="पेश गर्नुहोस्"
            />
        </div>
    </form>
</template>
<script setup>

import {onMounted, reactive, ref, watch} from "vue";
import {useSettingStore} from "../../stores/setting";
import {useMapApplicationStore} from "../../stores/e-map/mapApplication";
import {storeToRefs} from "pinia";
import showErrors from "../../utils/showErrors";
import {useYup} from "../../utils/yup";
import {object,string} from "yup";
import Swal from "sweetalert2";

const settingStore=useSettingStore();
const mapApplicationStore=useMapApplicationStore();
const {eMapSetting}=storeToRefs(settingStore);

onMounted(()=>{
    settingStore.getEMapSetting();
})

const house_owner_as_land_owner=ref(false);

const initialState={
    organization_id:'',
    application_type:'',
    construction_type:'',
    current_storey:'',
    future_storey:'',
    latitude:'',
    longitude:'',
    landDetail:{
        ward_no:'',
        former_ward_no:'',
        tole:'',
        plot_no:'',
        unit_value:'',
    },
    landOwner:{
        land_owner_type:'',
        name:'',
        phone:'',
        father_name:'',
        grandfather_name:'',
        citizenship_no:'',
        citizenship_issue_date:'',
        citizenship_issue_district_id:'',
        address:'',
        local_body:'',
        ward_no:'',
    },
    houseOwner:{
        name:'',
        phone:'',
        father_name:'',
        grandfather_name:'',
        citizenship_no:'',
        citizenship_issue_date:'',
        citizenship_issue_district_id:'',
        address:'',
        local_body:'',
        ward_no:'',
    },
    applicantDetail:{
        applicant_type:'',
        relation_with_owner:'',
        name:'',
        phone:'',
        father_name:'',
        citizenship_no:'',
        citizenship_issue_date:'',
        citizenship_issue_district_id:'',
        application_date:'',
        signature:'',
    }
}

const form = reactive({...initialState})

const isSubmitting=ref(false);
const isApplicantSame=ref(false);

watch(()=>house_owner_as_land_owner.value,()=>{
    setLandOwnerToHouseOwner();
})

watch(()=>form.landOwner,()=>{
    setLandOwnerToHouseOwner();
},{deep:true})

const setLandOwnerToHouseOwner=()=>{
    if(house_owner_as_land_owner.value){
        form.houseOwner.name=form.landOwner.name;
        form.houseOwner.phone=form.landOwner.phone;
        form.houseOwner.father_name=form.landOwner.father_name;
        form.houseOwner.grandfather_name=form.landOwner.grandfather_name;
        form.houseOwner.citizenship_no=form.landOwner.citizenship_no;
        form.houseOwner.citizenship_issue_date=form.landOwner.citizenship_issue_date;
        form.houseOwner.citizenship_issue_district_id=form.landOwner.citizenship_issue_district_id;
        form.houseOwner.address=form.landOwner.address;
        form.houseOwner.local_body=form.landOwner.local_body;
        form.houseOwner.ward_no=form.landOwner.ward_no;
    }else{
        form.houseOwner.name='';
        form.houseOwner.phone='';
        form.houseOwner.father_name='';
        form.houseOwner.grandfather_name='';
        form.houseOwner.citizenship_no='';
        form.houseOwner.citizenship_issue_date='';
        form.houseOwner.citizenship_issue_district_id='';
        form.houseOwner.address='';
        form.houseOwner.local_body='';
        form.houseOwner.ward_no='';
    }
}

watch(()=>form.applicantDetail.applicant_type,(type)=>{
    if(type==='house owner'){
        isApplicantSame.value=true;
        form.applicantDetail.name=form.houseOwner.name;
        form.applicantDetail.phone=form.houseOwner.phone;
        form.applicantDetail.father_name=form.houseOwner.father_name;
        form.applicantDetail.citizenship_no=form.houseOwner.citizenship_no;
        form.applicantDetail.citizenship_issue_date=form.houseOwner.citizenship_issue_date;
        form.applicantDetail.citizenship_issue_district_id=form.houseOwner.citizenship_issue_district_id;
    }else if (type==='land owner'){
        isApplicantSame.value=true;
        form.applicantDetail.name=form.landOwner.name;
        form.applicantDetail.phone=form.landOwner.phone;
        form.applicantDetail.father_name=form.landOwner.father_name;
        form.applicantDetail.citizenship_no=form.landOwner.citizenship_no;
        form.applicantDetail.citizenship_issue_date=form.landOwner.citizenship_issue_date;
        form.applicantDetail.citizenship_issue_district_id=form.landOwner.citizenship_issue_district_id;
    }else{
        isApplicantSame.value=false;
        form.applicantDetail.name='';
        form.applicantDetail.phone='';
        form.applicantDetail.father_name='';
        form.applicantDetail.citizenship_no='';
        form.applicantDetail.citizenship_issue_date='';
        form.applicantDetail.citizenship_issue_district_id='';
    }
})

const validations = object({
    organization_id: string().required('अनिवार्य छ'),
    application_type: string().required('अनिवार्य छ'),
    construction_type: string().required('निर्माण कार्यको किसिम अनिवार्य छ |'),
    current_storey:string().required('तल्ला संख्या अनिवार्य छ|'),
    future_storey:string().required('अनिवार्य छ'),
    latitude:string().required('अनिवार्य छ'),
    longitude:string().required('अनिवार्य छ'),
    landDetail:object().shape({
        ward_no:string().required('अनिवार्य छ'),
        former_ward_no:string().required('अनिवार्य छ'),
        tole:string().required('अनिवार्य छ'),
        plot_no:string().required('अनिवार्य छ'),
        unit_value:string().required('अनिवार्य छ'),
    }),
    landOwner:object().shape({
        land_owner_type:string().required('जग्गा धनीको किसिम अनिवार्य छ'),
        name:string().required('जग्गा धनीको नाम अनिवार्य छ'),
        phone:string(),
        father_name:string().required('बुवाको नाम अनिवार्य छ'),
        grandfather_name:string().required('हजुरबुबाको नाम अनिवार्य छ'),
        citizenship_no:string().required('नागरिकता नम्बर अनिवार्य छ'),
        citizenship_issue_date:string().required('नागरिकता लिएको मिति अनिवार्य छ'),
        citizenship_issue_district_id:string().required('नागरिकता लिएको जिल्ला अनिवार्य छ'),
        address:string().required('ठेगाना अनिवार्य छ'),
        local_body:string().required('पालिका अनिवार्य छ'),
        ward_no:string().required('वडा नं. अनिवार्य छ'),
    }),
    houseOwner:object().shape({
        name:string().required('घर धनीको नाम अनिवार्य छ'),
        phone:string(),
        father_name:string().required('बुवाको नाम अनिवार्य छ'),
        grandfather_name:string().required('हजुरबुबाको नाम अनिवार्य छ'),
        citizenship_no:string().required('नागरिकता नम्बर अनिवार्य छ'),
        citizenship_issue_date:string().required('नागरिकता लिएको मिति अनिवार्य छ'),
        citizenship_issue_district_id:string().required('नागरिकता लिएको जिल्ला अनिवार्य छ'),
        address:string().required('ठेगाना अनिवार्य छ'),
        local_body:string().required('पालिका अनिवार्य छ'),
        ward_no:string().required('वडा नं. अनिवार्य छ'),
    }),
    applicantDetail:object().shape({
        applicant_type:string().required('निवेदकको प्रकार अनिवार्य छ'),
        relation_with_owner:string().required('सम्बन्ध अनिवार्य छ'),
        name:string().required('निवेदकको नाम अनिवार्य छ'),
        phone:string().required('फोन न. अनिवार्य छ'),
        father_name:string().required('बुवाको नाम अनिवार्य छ'),
        citizenship_no:string().required('नागरिकता नम्बर अनिवार्य छ'),
        citizenship_issue_date:string().required('नागरिकता लिएको मिति अनिवार्य छ'),
        citizenship_issue_district_id:string().required('नागरिकता लिएको जिल्ला अनिवार्य छ'),
        application_date:string(),
        //signature:object(),
    })
});

const {errors, validateField, validateForm} = useYup(form, validations);

const registerApplication=async () => {
    let validated = await validateForm(validations, form)
    if (validated) {
        isSubmitting.value = true;
        try {
            let res = await mapApplicationStore.storeMapApplication(form);
            isSubmitting.value=false;
            resetForm();
            await Swal.fire({
                title: 'धन्यबाद!!!',
                text: `तपाईंको फारम सफलतापूर्वक पेश भएको छ, तपाईंको सबमिशन नं. ${res.data.data?.unique_id} हो। कृपया भविष्यमा प्रयोगको लागि सबमिशन नं. सुरक्षित राख्नुहोस् ।`,
                icon: 'success',
            });
        }catch (e) {
            showErrors(e);
            isSubmitting.value=false;
        }
    }
}

const resetForm=()=> {
    errors.value = {};
    resetNestedObject(form);
}

const resetNestedObject=(obj)=> {
    for (const key in obj) {
        if (typeof obj[key] === 'object' && obj[key] !== null) {
            resetNestedObject(obj[key]);
        } else {
            obj[key] = '';
        }
    }
}

</script>
