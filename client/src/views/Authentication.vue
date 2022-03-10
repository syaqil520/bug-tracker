<template lang="">
    <div class="items-center justify-center flex  min-h-screen ">
        <div class="w-full max-w-lg mx-auto overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div class="px-6 py-4">
                <h2 class="text-3xl font-bold text-center text-gray-700 dark:text-white">Bug Tracker</h2>

                <h3 class="mt-1 text-xl font-medium text-center text-gray-600 dark:text-gray-200">Welcome Back</h3>


                <form @submit.prevent="login">
                    <div class="w-full mt-4">
                        <input class="basic-input" type="email" placeholder="Email Address" aria-label="Email Address" v-model="userData.email" />
                    </div>

                    <div class="w-full mt-4">
                        <input class="basic-input" type="password" placeholder="Password" aria-label="Password" v-model="userData.password" />
                    </div>

                    <div class="mt-6">
                        <!-- <a href="#" class="text-sm text-gray-600 dark:text-gray-200 hover:text-gray-500">Forget Password?</a> -->
                        <button class="btn-primary w-full" type="submit"  >Login</button>
                    </div>
                </form>
            </div>

            <div class="flex items-center justify-center py-4 text-center bg-gray-100 ">
                <span class="text-sm text-gray-600 dark:text-gray-200">Don't have an account? </span>

                <a href="#" class="mx-2 text-sm font-bold text-blue-500 dark:text-blue-400 hover:underline" >Register</a>
            </div>
        </div>
       
    </div>
</template>
<script >
import { reactive, ref, toRaw } from 'vue'
import api from '@/api/authenticationApi'
import {useRouter} from 'vue-router'
import { useStore } from 'vuex'
export default {
    name: 'Authentication',
    setup() {
        const processing = ref(false)    
        const userData = reactive({
            email: '',
            password: ''
        })

        const router = useRouter()
        const store = useStore()

        async function login() {
            try {
                if(!processing.value) {
                    processing.value = true
                    const data  = await store.dispatch('login', toRaw(userData))
                    if(data.success) {
                        processing.value = false
                        router.push({ name: 'Home'})
                    } else {
                        alert('error login')
                        console.log(data)
                        processing.value = false 

                    }
                }
            } catch (error) {
                console.log(error)
            }
        }

        // async function login() {
        //     try {
        //         await api.createSession()
        //         const {data} = await api.login(toRaw(userData))
        //         if(data.success) {
        //             router.push({name: 'Home'})                    
        //         } else {
        //             console.log(data)
        //         }
        //     } catch (error) {
        //         console.log(error)
        //     }
        // }


        return {
            userData,
            login,
        }
    }
}

</script>
<style lang="">
    
</style>