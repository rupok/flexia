/**
 * Customizer toggle dependency
 *
 * @package Flexia
 */

(function($) {

    'use strict';

    var customizer_api = wp.customize;

    /**
     * Helper class for the main Customizer interface.
     */
    var Flexia_Customizer = {

        controls: {},

        /**
         * Initializes the logic for showing and hiding controls
         * when a setting ready or changes 
         *
         */
        init: function() {
            var self = this;
            wp.customize.bind('ready', function() {

                self.handleRequired();

            });

            customizer_api.bind('change', function(setting, data) {

                var has_dependents = self.hasRequiredControls(setting.id);

                if (has_dependents) {

                    self.handleRequired();

                }
            });
        },

        hasRequiredControls: function(control_id) {

            var check = false;

            $.each(config, function(index, val) {

                if (!_.isUndefined(val.conditions)) {

                    var conditions = val.conditions;

                    $.each(conditions, function(index, val) {

                        var control = val[0];

                        if (control_id == control) {
                            check = true;
                            return;
                        }
                    });

                } else {

                    var control = val[0];

                    if (control_id == control) {
                        check = true;
                        return;
                    }
                }

            });

            return check;

        },

        /**
         * Handles dependency for controls.
         *
         * @method handleRequired
         */
        handleRequired: function() {
            var self = this;
            var values = customizer_api.get();

            self.checked_controls = {};

            _.each(values, function(value, id) {
                var control = customizer_api.control(id);
                self.checkControlVisibility(control, id);
            });
        },

        /**
         * Hide OR display controls according to dependency
         *
         * @method checkControlVisibility
         */
        checkControlVisibility: function(control, id) {

            var self = this;
            var values = customizer_api.get();

            if (!_.isUndefined(control)) {

                // If control has required defined
                if ('undefined' != typeof config[id]) {
                    var check = false;
                    var conditions = config[id];
                    var operator = 'AND';

                    if ('undefined' !== typeof conditions) {
                        check = self.checkDependency(conditions, values, operator);

                        this.checked_controls[id] = check;

                        if (!check) {
                            control.container.hide(180);
                        } else {
                            control.container.show(180);
                        }
                    }
                }
            }
        },

        /**
         * Checks dependency conditions for controls
         *
         * @method checkDependency
         */
        checkDependency: function(conditions, values, compare_operator) {

            var control = this;
            var check = true;
            var returnNow = false;
            var condition_key = conditions[0];

            if (_.isString(condition_key)) {

                var cond = conditions[1];
                var cond_val = conditions[2];
                var value;

                if (!_.isUndefined(config[condition_key])) {

                    var conditions = config[condition_key];
                    var operator = 'AND';

                    if (!_.isUndefined(conditions)) {

                        // Check visibility for dependent controls also
                        if (!control.checkDependency(conditions, values, operator)) {
                            returnNow = true;
                            check = false;
                            if ('AND' == compare_operator) {
                                return;
                            }
                        } else {
                            var control_obj = customizer_api.control(condition_key);
                            control_obj.container.show(180);
                        }
                    }
                }

                if (!_.isUndefined(values[condition_key]) && !returnNow && check) {
                    value = values[condition_key];
                    check = control.compareValues(value, cond, cond_val);
                }

            }

            return check;
        },

        /**
         * Compare values
         *
         * @method compareValues
         */
        compareValues: function(value1, cond, value2) {
            var equal = false;
            switch (cond) {
                case '===':
                    equal = (value1 === value2) ? true : false;
                    break;
                case '>':
                    equal = (value1 > value2) ? true : false;
                    break;
                case '<':
                    equal = (value1 < value2) ? true : false;
                    break;
                case '<=':
                    equal = (value1 <= value2) ? true : false;
                    break;
                case '>=':
                    equal = (value1 >= value2) ? true : false;
                    break;
                case '!=':
                    equal = (value1 != value2) ? true : false;
                    break;
                default:
                    if (_.isArray(value2)) {
                        if (!_.isEmpty(value2) && !_.isEmpty(value1)) {
                            equal = _.contains(value2, value1);
                        } else {
                            equal = false;
                        }
                    } else {
                        equal = (value1 == value2) ? true : false;
                    }
            }

            return equal;
        },
    };

    $(function() { Flexia_Customizer.init(); });


})(jQuery);