import { ref, computed } from "vue";

export default function usePagination(items, itemsPerPage = 5) {
    const currentPage = ref(1);

    const totalPages = computed(() => Math.ceil(items.value.length / itemsPerPage));

    const paginatedItems = computed(() => {
        const start = (currentPage.value - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        return items.value.slice(start, end);
    });

    const pageNumbers = computed(() => {
        const total = totalPages.value;
        const current = currentPage.value;
        const pages = [];

        if (total <= 5) {
            for (let i = 1; i <= total; i++) {
                pages.push(i);
            }
        } else {
            pages.push(1);
            if (current > 3) pages.push("...");
            for (let i = Math.max(2, current - 1); i <= Math.min(current + 1, total - 1); i++) {
                pages.push(i);
            }
            if (current < total - 2) pages.push("...");
            pages.push(total);
        }

        return pages;
    });

    const changePage = (page) => {
        if (page > 0 && page <= totalPages.value) {
            currentPage.value = page;
        }
    };

    return {
        currentPage,
        totalPages,
        paginatedItems,
        pageNumbers,
        changePage,
    };
}
