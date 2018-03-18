<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li v-for="n in paginationRange" :class="activePage(n)">
                <a href="#" @click.prevent="pageChanged(n)">{{ n }}</a>
            </li>
        </ul>
    </nav>
</template>

<script type="text/babel">

	export default {
		props: {
			currentPage: {
				type: Number,
				required: true
			},
            url: String,
			totalPages: Number,
			itemsPerPage: Number,
			totalItems: Number,
			visiblePages: {
				type: Number,
				default: 5,
			}
        },

        computed: {
			lastPage () {
				if (this.totalPages) {
					return this.totalPages
				} else {
					return this.totalItems % this.itemsPerPage === 0
						? this.totalItems / this.itemsPerPage
						: Math.floor(this.totalItems / this.itemsPerPage) + 1
				}
			},

			paginationRange () {

				console.log(this.currentPage + this.visiblePages / 2, this.lastPage);

				let start =
					this.currentPage - this.visiblePages / 2 <= 0
						? 1 : this.currentPage + this.visiblePages / 2 > this.lastPage
						? this.lowerBound(this.lastPage - this.visiblePages + 1, 1)
						: Math.ceil(this.currentPage - this.visiblePages / 2);

				let range = [];

				for (let i = 0; i < this.visiblePages && i < this.lastPage; i++) {
					range.push(start + i)
				}

				return range
			}
        },

        methods: {
			activePage (page) {
				return this.currentPage === page ? 'active' : ''
			},
			pageChanged (page) {
                window.location = '/' + this.url + '?page=' + page;
			},
			lowerBound (num, limit) {
				return num >= limit ? num : limit
			}
        }
	}
</script>
