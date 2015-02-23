/*
* MultiSelect v0.9.8
* Copyright (c) 2012 Louis Cun
*/

!function(a){"use strict";var b=function(b,c){this.options=c,this.$element=a(b),this.$container=a("<div/>",{"class":"ms-container"}),this.$selectableContainer=a("<div/>",{"class":"ms-selectable"}),this.$selectionContainer=a("<div/>",{"class":"ms-selection"}),this.$selectableUl=a("<ul/>",{"class":"ms-list",tabindex:"-1"}),this.$selectionUl=a("<ul/>",{"class":"ms-list",tabindex:"-1"}),this.scrollTo=0,this.sanitizeRegexp=new RegExp("\\W+","gi"),this.elemsSelector="li:visible:not(.ms-optgroup-label,.ms-optgroup-container,."+c.disabledClass+")"};b.prototype={constructor:b,init:function(){var b=this,c=this.$element;if(0===c.next(".ms-container").length){c.css({position:"absolute",left:"-9999px"}),c.attr("id",c.attr("id")?c.attr("id"):Math.ceil(1e3*Math.random())+"multiselect"),this.$container.attr("id","ms-"+c.attr("id")),c.find("option").each(function(){b.generateLisFromOption(this)}),this.$selectionUl.find(".ms-optgroup-label").hide(),b.options.selectableHeader&&b.$selectableContainer.append(b.options.selectableHeader),b.$selectableContainer.append(b.$selectableUl),b.options.selectableFooter&&b.$selectableContainer.append(b.options.selectableFooter),b.options.selectionHeader&&b.$selectionContainer.append(b.options.selectionHeader),b.$selectionContainer.append(b.$selectionUl),b.options.selectionFooter&&b.$selectionContainer.append(b.options.selectionFooter),b.$container.append(b.$selectableContainer),b.$container.append(b.$selectionContainer),c.after(b.$container),b.activeMouse(b.$selectableUl),b.activeKeyboard(b.$selectableUl);var d=b.options.dblClick?"dblclick":"click";b.$selectableUl.on(d,".ms-elem-selectable",function(){b.select(a(this).data("ms-value"))}),b.$selectionUl.on(d,".ms-elem-selection",function(){b.deselect(a(this).data("ms-value"))}),b.activeMouse(b.$selectionUl),b.activeKeyboard(b.$selectionUl),c.on("focus",function(){b.$selectableUl.focus()})}var e=c.find("option:selected").map(function(){return a(this).val()}).get();b.select(e,"init"),"function"==typeof b.options.afterInit&&b.options.afterInit.call(this,this.$container)},generateLisFromOption:function(b){for(var c=this,d=c.$element,e="",f=a(b),g=0;g<b.attributes.length;g++){var h=b.attributes[g];"value"!==h.name&&(e+=h.name+'="'+h.value+'" ')}var i=a("<li "+e+"><span>"+f.text()+"</span></li>"),j=i.clone(),k=f.val(),l=c.sanitize(k,c.sanitizeRegexp);i.data("ms-value",k).addClass("ms-elem-selectable").attr("id",l+"-selectable"),j.data("ms-value",k).addClass("ms-elem-selection").attr("id",l+"-selection").hide(),(f.prop("disabled")||d.prop("disabled"))&&(j.addClass(c.options.disabledClass),i.addClass(c.options.disabledClass));var m=f.parent("optgroup");if(m.length>0){var n=m.attr("label"),o=c.sanitize(n,c.sanitizeRegexp),p=c.$selectableUl.find("#optgroup-selectable-"+o),q=c.$selectionUl.find("#optgroup-selection-"+o);if(0===p.length){var r='<li class="ms-optgroup-container"></li>',s='<ul class="ms-optgroup"><li class="ms-optgroup-label"><span>'+n+"</span></li></ul>";p=a(r),q=a(r),p.attr("id","optgroup-selectable-"+o),q.attr("id","optgroup-selection-"+o),p.append(a(s)),q.append(a(s)),c.options.selectableOptgroup&&(p.find(".ms-optgroup-label").on("click",function(){var b=m.children(":not(:selected)").map(function(){return a(this).val()}).get();c.select(b)}),q.find(".ms-optgroup-label").on("click",function(){var b=m.children(":selected").map(function(){return a(this).val()}).get();c.deselect(b)})),c.$selectableUl.append(p),c.$selectionUl.append(q)}p.children().append(i),q.children().append(j)}else c.$selectableUl.append(i),c.$selectionUl.append(j)},activeKeyboard:function(b){var c=this;b.on("focus",function(){a(this).addClass("ms-focus")}).on("blur",function(){a(this).removeClass("ms-focus")}).on("keydown",function(d){switch(d.which){case 40:case 38:return d.preventDefault(),d.stopPropagation(),c.moveHighlight(a(this),38===d.which?-1:1),void 0;case 32:return d.preventDefault(),d.stopPropagation(),c.selectHighlighted(b),void 0;case 37:case 39:return d.preventDefault(),d.stopPropagation(),c.switchList(b),void 0}})},moveHighlight:function(a,b){var c=a.find(this.elemsSelector),d=c.filter(".ms-hover"),e=null,f=c.first().outerHeight(),g=a.height();if("#"+this.$container.prop("id"),c.off("mouseenter"),c.removeClass("ms-hover"),1===b){if(e=d.nextAll(this.elemsSelector).first(),0===e.length){var i=d.parent();if(i.hasClass("ms-optgroup")){var j=i.parent(),k=j.next(":visible");e=k.length>0?k.find(this.elemsSelector).first():c.first()}else e=c.first()}}else if(-1===b&&(e=d.prevAll(this.elemsSelector).first(),0===e.length)){var i=d.parent();if(i.hasClass("ms-optgroup")){var j=i.parent(),l=j.prev(":visible");e=l.length>0?l.find(this.elemsSelector).last():c.last()}else e=c.last()}if(e.length>0){e.addClass("ms-hover");var m=a.scrollTop()+e.position().top-g/2+f/2;a.scrollTop(m)}},selectHighlighted:function(a){var b=a.find(this.elemsSelector),c=b.filter(".ms-hover").first();c.length>0&&(a.parent().hasClass("ms-selectable")?this.select(c.data("ms-value")):this.deselect(c.data("ms-value")),b.removeClass("ms-hover"))},switchList:function(a){a.blur(),a.parent().hasClass("ms-selectable")?this.$selectionUl.focus():this.$selectableUl.focus()},activeMouse:function(b){var c=this;b.on("mousemove",function(){var d=b.find(c.elemsSelector);d.on("mouseenter",function(){d.removeClass("ms-hover"),a(this).addClass("ms-hover")})})},refresh:function(){this.destroy(),this.$element.multiSelect(this.options)},destroy:function(){a("#ms-"+this.$element.attr("id")).remove(),this.$element.removeData("multiselect")},select:function(b,c){"string"==typeof b&&(b=[b]);var d=this,e=this.$element,f=a.map(b,function(a){return d.sanitize(a,d.sanitizeRegexp)}),g=this.$selectableUl.find("#"+f.join("-selectable, #")+"-selectable").filter(":not(."+d.options.disabledClass+")"),h=this.$selectionUl.find("#"+f.join("-selection, #")+"-selection").filter(":not(."+d.options.disabledClass+")"),i=e.find("option:not(:disabled)").filter(function(){return a.inArray(this.value,b)>-1});if(g.length>0){g.addClass("ms-selected").hide(),h.addClass("ms-selected").show(),i.prop("selected",!0);var j=d.$selectableUl.children(".ms-optgroup-container");if(j.length>0){j.each(function(){var b=a(this).find(".ms-elem-selectable");b.length===b.filter(".ms-selected").length&&a(this).find(".ms-optgroup-label").hide()});var k=d.$selectionUl.children(".ms-optgroup-container");k.each(function(){var b=a(this).find(".ms-elem-selection");b.filter(".ms-selected").length>0&&a(this).find(".ms-optgroup-label").show()})}else if(d.options.keepOrder){var l=d.$selectionUl.find(".ms-selected");l.length>1&&l.last().get(0)!=h.get(0)&&h.insertAfter(l.last())}"init"!==c&&(e.trigger("change"),"function"==typeof d.options.afterSelect&&d.options.afterSelect.call(this,b))}},deselect:function(b){"string"==typeof b&&(b=[b]);var c=this,d=this.$element,e=a.map(b,function(a){return c.sanitize(a,c.sanitizeRegexp)}),f=this.$selectableUl.find("#"+e.join("-selectable, #")+"-selectable"),g=this.$selectionUl.find("#"+e.join("-selection, #")+"-selection").filter(".ms-selected"),h=d.find("option").filter(function(){return a.inArray(this.value,b)>-1});if(g.length>0){f.removeClass("ms-selected").show(),g.removeClass("ms-selected").hide(),h.prop("selected",!1);var i=c.$selectableUl.children(".ms-optgroup-container");if(i.length>0){i.each(function(){var b=a(this).find(".ms-elem-selectable");b.filter(":not(.ms-selected)").length>0&&a(this).find(".ms-optgroup-label").show()});var j=c.$selectionUl.children(".ms-optgroup-container");j.each(function(){var b=a(this).find(".ms-elem-selection");0===b.filter(".ms-selected").length&&a(this).find(".ms-optgroup-label").hide()})}d.trigger("change"),"function"==typeof c.options.afterDeselect&&c.options.afterDeselect.call(this,b)}},select_all:function(){var b=this.$element,c=b.val();if(b.find('option:not(":disabled")').prop("selected",!0),this.$selectableUl.find(".ms-elem-selectable").filter(":not(."+this.options.disabledClass+")").addClass("ms-selected").hide(),this.$selectionUl.find(".ms-optgroup-label").show(),this.$selectableUl.find(".ms-optgroup-label").hide(),this.$selectionUl.find(".ms-elem-selection").filter(":not(."+this.options.disabledClass+")").addClass("ms-selected").show(),this.$selectionUl.focus(),b.trigger("change"),"function"==typeof this.options.afterSelect){var d=a.grep(b.val(),function(b){return a.inArray(b,c)<0});this.options.afterSelect.call(this,d)}},deselect_all:function(){var a=this.$element,b=a.val();a.find("option").prop("selected",!1),this.$selectableUl.find(".ms-elem-selectable").removeClass("ms-selected").show(),this.$selectionUl.find(".ms-optgroup-label").hide(),this.$selectableUl.find(".ms-optgroup-label").show(),this.$selectionUl.find(".ms-elem-selection").removeClass("ms-selected").hide(),this.$selectableUl.focus(),a.trigger("change"),"function"==typeof this.options.afterDeselect&&this.options.afterDeselect.call(this,b)},sanitize:function(a,b){return a.replace(b,"_")}},a.fn.multiSelect=function(){var c=arguments[0],d=arguments;return this.each(function(){var e=a(this),f=e.data("multiselect"),g=a.extend({},a.fn.multiSelect.defaults,e.data(),"object"==typeof c&&c);f||e.data("multiselect",f=new b(this,g)),"string"==typeof c?f[c](d[1]):f.init()})},a.fn.multiSelect.defaults={selectableOptgroup:!1,disabledClass:"disabled",dblClick:!1,keepOrder:!1},a.fn.multiSelect.Constructor=b}(window.jQuery);