<template>
    <table>
        <thead class="border-b bg-gray-800">
            <tr>
                <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                    #
                </th>
                <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                    Semester
                </th>
                <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                    Value
                </th>
            </tr>
        </thead>
        <tbody class="border-b">
            <tr v-for="data in tabledata" :key="data.id" class="bg-white border-b transition duration-300 ease-in-out hover:bg-blue-100">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    {{ data.id }}
                </td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    {{ data.semester_name }}
                </td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    {{ data.semester_value }}%
                </td>
            </tr>
        </tbody>
    </table>
</template>
<script>
export default {
    props: ["tabledata"],
};
</script>
