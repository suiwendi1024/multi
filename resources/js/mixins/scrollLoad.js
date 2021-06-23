export default {
    mounted() {
        this.$_onScroll()
    },

    methods: {
        $_onScroll() {
            let scroll = () => {
                if (document.documentElement.offsetHeight - document.documentElement.scrollTop - window.innerHeight < 200) {
                    window.removeEventListener('scroll', scroll, true)
                    this.$_fetchData()
                }
            }

            window.addEventListener('scroll', scroll, true)
        },

        $_fetchData() {
            if (this.nextPageUrl) {
                axios.get(this.nextPageUrl).then(response => {
                    this.nextPageUrl = response.data.links.next

                    this.items = this.items.concat(response.data.data)
                    this.$_onScroll()
                })
            }
        },
    }
}
