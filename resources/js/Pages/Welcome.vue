<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Welcome" />
    <nav class="bg-cyan-900 w-100 text-slate-50 py-2">
        <div class="md:container md:mx-auto">
            <ul class="list-none inline-flex font-khmer text-sm items-center">
                <li class="m-0">
                    <a href="#">
                        <img
                            src="https://www.moe.gov.kh/wp-content/uploads/2019/05/cropped-ic-moe-logo.png"
                            class="h-12 p-0 min-w-max"
                        />
                    </a>
                </li>
                <li class="m-2 ml-5">
                    <a href="#" class="hover:text-slate-200 whitespace-nowrap"
                        >ទំព័រដើម</a
                    >
                </li>
                <li class="m-2">
                    <a href="#" class="hover:text-slate-200 whitespace-nowrap"
                        >អំពីក្រសួង</a
                    >
                </li>
                <li class="m-2">
                    <a href="#" class="hover:text-slate-200 whitespace-nowrap"
                        >ច្បាប់និងលិខិតបទដ្ឋាន</a
                    >
                </li>
                <li class="m-2">
                    <a href="#" class="hover:text-slate-200 whitespace-nowrap"
                        >មជ្ឈមណ្ឌលពត៍មាន</a
                    >
                </li>
                <li class="m-2">
                    <a href="#" class="hover:text-slate-200 whitespace-nowrap"
                        >មជ្ឈមណ្ឌលពត៍មាន</a
                    >
                </li>
            </ul>
        </div>
    </nav>
</template>
<script>
export default {
    layout: [],
};
</script>
