const Helper = {
    install(Vue, options) {
        Vue.mixin({
            created() {
                this.auth = options.auth;
                this.csrf = options.csrf;
                this.seller = options.seller;
                this.authCode = options.authCode;
            },
            data() {
                return {
                    auth: false,
                    csrf: null,
                    seller: false,
                    authCode: null
                }
            },
            methods: {
                lowerCase(string) {
                    return _.lowerCase(string);
                },
                upper(string) {
                    return _.upperCase(string);
                },
                ucFirst(string) {
                    return _.upperFirst(string);
                },
                camel(string) {
                    return _.startCase(string);
                },
                commas(num) {
                    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                },
                isMe(code) {
                    return this.lowerCase(code) === this.lowerCase(this.authCode);
                },
                openPaymentModal(amount, email, currency, meta, callback) {
                    return getpaidSetup({
                        PBFPubKey: RavePublicKey,
                        customer_email: email,
                        amount: amount,
                        currency: currency,
                        txref: Uuid(),
                        meta: meta,
                        onclose: function() {},
                        callback: callback
                    });
                }
            },
            filters: {
                commas(num) {
                    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                },
                lowerCase(string) {
                    return _.lowerCase(string);
                },
                ucFirst(string) {
                    return _.upperFirst(string);
                },
                camel(string) {
                    return _.startCase(string);
                },
                time(date) {
                    return Moment(date).format("h:mm a");
                },
                day(date) {
                    if (Moment().isSame(Moment(date), 'd'))
                        return 'Today';

                    if (Moment().subtract(1, 'days').isSame(Moment(date), 'd'))
                        return 'Yesterday';

                    return Moment(date).format("MMM D, YYYY");
                },
                dayOrTime(date) {
                    if (Moment().isSame(Moment(date), 'd'))
                        return Moment(date).format("h:mm a");

                    if (Moment().subtract(1, 'days').isSame(Moment(date), 'd'))
                        return 'Yesterday';

                    return Moment(date).format("MM/DD/YY");
                },
                fromNow(date) {
                    return Moment(date).fromNow();
                },
                timeSpecific(date) {
                    let time = Moment(date).format("h:mm a");
                    if (Moment().isSame(Moment(date), 'd'))
                        return `Today at ${time}`;

                    if (Moment().subtract(1, 'days').isSame(Moment(date), 'd'))
                        return `Yesterday at ${time}`;

                    return `${Moment(date).format("dddd, MMMM Do YYYY")} at ${time}`;
                },
                humanise(date) {
                    return Moment(date).format("dddd, MMMM Do YYYY");
                }
            }
        });
    }
};

export default Helper;