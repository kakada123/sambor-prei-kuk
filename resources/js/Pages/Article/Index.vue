<script setup>
import { Table } from "@protonemedia/inertiajs-tables-laravel-query-builder";

defineProps(["articles"]);
</script>

<template>
    <Table :resource="articles" />
</template>
