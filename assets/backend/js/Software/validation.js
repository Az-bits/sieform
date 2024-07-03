export default function Validation(form) {
    var validator = FormValidation.formValidation(form, {
        locale: 'es_ES',
        localization: FormValidation.locales.es_ES,
        fields: {
            ci: {
                validators: {
                    notEmpty: {},
                    stringLength: {
                        min: 7,
                        max: 14,
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9\-]+$/,
                    },
                },
            },
            ci2: {
                validators: {
                    notEmpty: {},
                    stringLength: {
                        min: 7,
                        max: 14,
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9\-]+$/,
                    },
                },
            },

        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            tachyons: new FormValidation.plugins.Tachyons(),
            submitButton: new FormValidation.plugins.SubmitButton(),
            icon: new FormValidation.plugins.Icon({
                valid: 'fa fa-check',
                invalid: 'fa fa-times',
                validating: 'fa fa-refresh',
            }),
        },
    });
    validator.validate().then(function (status) {
        console.log(status);
        if (status == 'Valid') {
            return true;
        } else {
            return false;
        }
    });
}