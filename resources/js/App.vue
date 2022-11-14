<template>
    <div class="isolate bg-violet-100">
        <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]">
            <svg class="relative left-[calc(50%-11rem)] -z-10 h-[21.1875rem] max-w-none -translate-x-1/2 rotate-[30deg] sm:left-[calc(50%-30rem)] sm:h-[42.375rem]" viewBox="0 0 1155 678" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill="url(#45de2b6b-92d5-4d68-a6a0-9b9b2abad533)" fill-opacity=".3" d="M317.219 518.975L203.852 678 0 438.341l317.219 80.634 204.172-286.402c1.307 132.337 45.083 346.658 209.733 145.248C936.936 126.058 882.053-94.234 1031.02 41.331c119.18 108.451 130.68 295.337 121.53 375.223L855 299l21.173 362.054-558.954-142.079z" />
                <defs>
                    <linearGradient id="45de2b6b-92d5-4d68-a6a0-9b9b2abad533" x1="1155.49" x2="-78.208" y1=".177" y2="474.645" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#9089FC" />
                        <stop offset="1" stop-color="#FF80B5" />
                    </linearGradient>
                </defs>
            </svg>
        </div>
        <div class="px-6 pt-6 lg:px-8">
            <Header></Header>
        </div>
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-6 mx-auto my-10 rounded-lg shadow-lg bg-white">
                <p>
                    334553, 907087, 717042, 148569, 230181
                </p>
                <h3 class="font-medium leading-tight text-center text-3xl mt-0 mb-8 text-black">
                    CGPA
                </h3>
                <div class="flex flex-wrap mx-4 mb-10 text-center justify-center">
                    <div class="form-group mb-6">
                        <input type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInput123" aria-describedby="emailHelp123" placeholder="Enter Student Roll" v-model="studentRoll" />
                    </div>
                    <div class="form-group mb-4 ml-6">
                        <button type="button" class="px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight float-right uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" v-on:click="searchCGPA">
                            Search
                        </button>
                    </div>
                </div>
                <div class="flex flex-wrap flex-col w-80 mx-auto mb-10 text-center justify-center" v-if="cgpasearch">
                    <h4 class="font-medium leading-tight text-center text-1xl mt-0 mb-8 text-black">
                        Name: {{ studentName }}
                        <br>
                        CGPA : {{ cgpa }}
                    </h4>
                    <table>
                        <thead class="border-b bg-gray-800">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                    Semester
                                </th>
                                <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                    Value
                                </th>
                            </tr>
                        </thead>
                        <tbody class="border-b">
                            <tr v-for="gpa in gpas" :key="gpa.eam_id" class="bg-white border-b transition duration-300 ease-in-out hover:bg-blue-100">
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ gpa.semesterName }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ gpa.gpa }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-6 mx-auto my-10 p-6 rounded-lg shadow-lg bg-white">
                <div id="toast-default" class="fixed right-8 top-20 flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert" v-if="alertActive">
                    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-blue-500 bg-blue-100 rounded-lg dark:bg-blue-800 dark:text-blue-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3 text-sm font-normal">
                        {{ alertMessage }}
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" aria-label="Close" v-on:click="alertClose">
                        <span class="sr-only">Close</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <h3 class="font-medium leading-tight text-center text-3xl mt-0 mb-8 text-black">
                    Semester Regulation
                </h3>
                <div class="flex flex-wrap -mx-4 -mb-10 text-center">
                    <div class="sm:w-1/2 mb-10 px-4">
                        <div class="w-80 m-auto">
                            <div class="form-group mb-6">
                                <select class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example" v-model="mySemesterValue" @change="onSemesterChange(mySemesterValue)">
                                    <option value="">Select Semester</option>
                                    <option v-for="semester in semesters" :key="semester.id + semester.name" v-bind:value="{
                                            id: semester.id,
                                            text: semester.name,
                                        }">
                                        {{ semester.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group mb-6">
                                <input type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInput123" aria-describedby="emailHelp123" placeholder="Semester Value in %" v-if="mySemesterValueInput" v-model="mySemesterValuePercentage" />
                            </div>
                            <button type="button" class="px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight float-right uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" v-on:click="submitRegulation">
                                Update
                            </button>
                        </div>
                    </div>
                    <div class="sm:w-1/2 mb-10 px-4">
                        <div class="flex justify-center">
                            <Table :tabledata="Regulation"></Table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
import Header from "./components/header.vue";
import Table from "./components/table.vue";
import axios from "axios";
export default {
    components: {
        Header,
        Table,
    },
    data() {
        return {
            students: [],
            semesters: [],
            subjects: [],
            mySemesterValue: "",
            myValue: "null",
            mySemesterValueInput: false,
            mySemesterValuePercentage: 0,
            Regulation: [],
            alertActive: false,
            alertMessage: "Loading.....",
            studentRoll: "",
            studentName: "",
            cgpa: "",
            gpas: [],
            cgpasearch: false,
        };
    },
    created() {
        const getSemesters = async () => {
            let res = await axios.get("api/semesters");
            this.semesters = res.data;
        };
        getSemesters();
        const getRegulaion = async () => {
            let res = await axios.get("api/regulation/all");
            this.Regulation = res.data;
        };
        getRegulaion();
    },
    methods: {
        onSemesterChange(semesterReturn) {
            if (semesterReturn == "") {
                this.mySemesterValueInput = false;
            } else {
                this.mySemesterValueInput = true;
            }
        },
        submitRegulation() {
            this.alertActive = true;
            this.mySemesterValuePercentage;
            this.mySemesterValue.id;
            const regul = {
                semester_id: this.mySemesterValue.id,
                semester_value: this.mySemesterValuePercentage,
            };
            axios.post("api/regulation", regul).then((resp) => {
                this.Regulation = resp.data;
                this.alertMessage = "Regulaition Updated.";
                this.mySemesterValueInput = false;
                this.mySemesterValue = "";
                setTimeout(() => (this.alertActive = false), 5000);
            });
        },
        alertClose() {
            this.alertActive = false;
        },
        searchCGPA() {
            this.alertActive = true;
            const roll = {
                roll: this.studentRoll,
            };
            axios.post("api/cgpa", roll).then((resp) => {
                console.log(resp);
                if (!resp.data.error) {
                    this.gpas = resp.data.semester;
                    this.studentName = resp.data.semester[0].name;
                    this.cgpa = parseFloat(resp.data.cgpa).toFixed(2);
                    this.cgpasearch = true;
                    this.alertMessage = "CGPA Genareted.";
                    setTimeout(() => (this.alertActive = false), 3000);
                }
            });
        },
    },
};
</script>
