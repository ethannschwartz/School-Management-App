<template>
    <section class="pt-[4em] bg-teal-100 text-[18px] text-slate-600">
        <div class="px-[30px] lg:px-[60px] py-[30px] lg:py-[60px]">
            <div class="relative h-[600px] block bg-white shadow-lg overflow-y-scroll">

<!--                header-->
                <ul class="flex justify-evenly items-center w-full h-[49px] shadow-sm">
                    <li class="h-full border-r border-slate-100">
                        <header class="w-[96px] h-full flex justify-center items-center border-b">
                            <h1 class="capitalize">time</h1>
                        </header>
                    </li>

                    <li v-for="day in daysOfWeek" class="w-full h-full border-r border-slate-100">
                        <header class="w-full h-full flex justify-center items-center border-b">
                            <h1 class="capitalize">{{ day }}</h1>
                        </header>
                    </li>

                </ul>

                <ul class="absolute top-[49px] flex justify-evenly items-center w-full h-full">
                    <li class="h-full border-r border-slate-100">
                        <header class="w-[96px] h-full flex flex-col justify-evenly items-end border-b text-right text-xs h-[49px]">
                            <div v-for="hour in hoursPerDay" class="flex items-center mr-[8px] border-t-[1px] border-slate-100">
                                <h1>{{ hour }}</h1>
                            </div>
                        </header>
                    </li>
                    <li v-for="day in daysOfWeek" class="flex flex-col justify-evenly w-full h-full border-r border-slate-100 pt-[1em]">
                        <div v-for="hour in hoursPerDay" class="border-t-[1px] border-slate-100 h-[49px]">
                            <div class="text-white text-xs">{{ hour }}</div>
                        </div>
                    </li>
                </ul>


            </div>
        </div>
    </section>

</template>

<script setup>

const daysOfWeek = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];


const hoursPerDay = [
    '6AM',
    '7AM',
    '8AM',
    '9AM',
    '10AM',
    '11AM',
    '12PM',
    '1PM',
    '2PM',
    '3PM',
    '4PM',
    '5PM',
    '6PM',
    '7PM',
    '8PM',
    '9PM',
];
</script>
