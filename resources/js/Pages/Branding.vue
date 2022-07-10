<template>

    <section id="top" class="h-auto bg-white mt-16 mx-8">

        <header class="text-xl md:text-2xl lg:text-3xl font-medium pb-4 w-full border-b p-2 mb-4">
            Publify Branding
        </header>

        <nav class="mb-4 pb-4 flex items-center justify-start gap-4 w-full border-b">
            <a href="#top" class="hover:underline underline-offset-4">Cards</a>
            <a href="#buttons" class="hover:underline underline-offset-4">Buttons</a>
            <a href="#SVGs" class="hover:underline underline-offset-4">SVGs</a>
            <a href="#colors" class="hover:underline underline-offset-4">Colors</a>
        </nav>

        <div class="pb-4 mb-4 border-b">
            <h2 class="text-xl font-medium mb-4">Cards</h2>
            <div class="flex gap-4 mb-4">
                FileCard:
                <FileCard :file="file" />
            </div>
            <div class="flex gap-4 mb-4">
                TeacherLink:
                <TeacherLink :is-seen="true" :teacher="teacher" />
            </div>
            <div class="flex gap-4 mb-4">
                CourseLink:
                <CourseLink :is-seen="false" :teacher="teacher" />
            </div>
        </div>

        <div id="buttons" class="pb-4 mb-4 border-b">

            <h2 class="text-xl font-medium mb-4">Buttons</h2>

            <div class="mb-4">
                <p>Submit:</p>
                <button class="bg-teal-600 hover:bg-teal-700 active:bg-teal-900 text-white py-2 px-4 rounded-sm uppercase tracking-wider">Submit</button>
            </div>

            <div class="mb-4">
                <p>Cancel:</p>
                <button class="bg-gray-600 hover:bg-gray-700 active:bg-gray-900 text-white py-2 px-4 rounded-sm uppercase tracking-wider">Cancel</button>
            </div>

            <div class="mb-4">
                <p>Link:</p>
                <a href="#buttons" class="underline underline-offset-4 text-teal-600 hover:text-black">Link</a>
            </div>

            <div class="mb-4">
                <p>Upload:</p>
                <label for="file" class="duration-150 flex items-center gap-2 bg-white border border-gray-300 hover:border-black rounded-md text-black py-2 px-4">
                    <BaseSvg name="icon-cloud-upload" />
                    Upload File
                </label>

                <input hidden type="file" placeholder="File" id="file" name="file" >
            </div>



        </div>

        <div id="SVGs" class="pb-4 mb-4 border-b">
            <h2 class="text-xl font-medium mb-4">SVGs</h2>
            <ul>
                <li>
                    <BaseSvg name="icon-closing-x" />
                </li>
                <li>
                    <BaseSvg name="icon-chevron-left" />
                </li>
                <li>
                    <BaseSvg name="icon-chevron-right" />
                </li>
                <li>
                    <BaseSvg name="icon-clipboard-copy" />
                </li>
                <li>
                    <BaseSvg name="icon-check" />
                </li>
                <li>
                    <BaseSvg name="icon-share" />
                </li>
                <li>
                    <BaseSvg name="icon-plus-sign" />
                </li>
                <li>
                    <BaseSvg name="icon-download" />
                </li>
                <li>
                    <BaseSvg name="icon-profile" />
                </li>
                <li>
                    <BaseSvg name="icon-delete" />
                </li>
                <li>
                    <BaseSvg name="icon-edit" />
                </li>
                <li>
                    <BaseSvg name="icon-add-box" />
                </li>
                <li>
                    <BaseSvg name="icon-closing-x-circle" />
                </li>
                <li>
                    <BaseSvg name="icon-chevron-up" />
                </li>
                <li>
                    <BaseSvg name="icon-chevron-down" />
                </li>
                <li>
                    <BaseSvg name="icon-icon-mail-envelope" />
                </li>
                <li>
                    <BaseSvg name="icon-icon-search" />
                </li>
            </ul>
        </div>

        <div id="colors" class="pb-4 mb-4 border-b">
            <h2 class="text-xl font-medium mb-4">Colors</h2>

            <div class="border w-fit">
                <div class="bg-black p-4 w-96 text-white">bg-black</div>
                <div class="bg-slate-900 p-4 w-96 text-white">bg-slate-900</div>
                <div class="bg-slate-800 p-4 w-96 text-white">bg-slate-800</div>
                <div class="bg-gray-800 p-4 w-96 text-white">bg-gray-800</div>
                <div class="bg-teal-700 p-4 w-96 text-white">bg-teal-700</div>
                <div class="bg-teal-600 p-4 w-96 text-white">bg-teal-600</div>
                <div class="bg-teal-300 p-4 w-96 text-black">bg-teal-300</div>
                <div class="bg-teal-200 p-4 w-96 text-black">bg-teal-200</div>
                <div class="bg-teal-100 p-4 w-96 text-black">bg-teal-100</div>
                <div class="bg-white p-4 w-96 text-black">bg-white</div>
            </div>
        </div>

    </section>

</template>

<script setup>
import {BaseSvg, FileCard, TeacherLink, CourseLink} from "@/Components";

const file = {
    title:'Example File',
    file: 'hello',
};

const teacher = {
    name:'John Appleseed',
    courses:[
        {
            id:1,
            title:'Example',
            section: 'A1',
        },
    ],
};

</script>
