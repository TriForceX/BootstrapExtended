var anythingOrder = anythingOrder || {params:{},texts:{}}

jQuery(document).ready(function($, undefined){
    var _spin  = $('.wp-list-table .column-anything-order .dashicons')

      , _list = $('#the-list').sortable({
            cursor      : 'move'
          , cursorAt    : {left:-10, top:0}
          , cancel      : '.no-items,.inline-editor'
          , placeholder : 'sortable-placeholder'
          , revert      : false
          , helper      : function(e, item){
                var parent    = item.parent()
                  , cols      = item.children(':visible').length
                  , width     = item.find('.row-title').closest('th, td').width()
                  , helper    = []
                  , selecteds = item

                if(item.hasClass('selected')){
                    selecteds = parent.children('.selected')
                }else{
                    item.addClass('selected').siblings().removeClass('selected')
                }

                item
                .data('anything-order-cols', cols)
                .data('anything-order-selecteds', selecteds.removeClass('selected').clone())
                .show()

                selecteds
                .addClass('sorting')
                .each(function(){
                    helper.push('<div>'+$(this).find('.row-title').text()+'</div>')
                })

                return $('<div>'+helper.join('')+'</div>').data('anything-order-helper', helper).width(width)
            }
          , start       : function(e, ui){
                var cols = ui.item.data('anything-order-cols')
                  , html = ui.helper.data('anything-order-pos', ui.position).data('anything-order-helper')

                ui.item.show()
                ui.placeholder.html('<td colspan="'+cols+'">'+html.join('')+'</td>')
            }
          , stop        : function(e, ui){
            if ( $(this).hasClass('cancel') ) {
                $(this).removeClass('cancel');
                getItems().filter('.sorting').removeClass('sorting');
            } else {
                ui.item.after(ui.item.data('anything-order-selecteds').addClass('sorted')).remove()
                getItems()
                    .filter('.sorting').remove().end()
                    .removeClass('alternate')
                    .filter(':nth-child(2n+1)').addClass('alternate')

                doUpdate(getIds($('#the-list .anything-order-id')))
            }

            }
          , update      : function(e, ui){
                ui.item.data('anything-order-update', true);
            }
        })

      , startUpdate = function(){
            _spin.addClass('spinner')
            _list.sortable('disable')
        }

      , doUpdate = function(ids){
            startUpdate()
            anythingOrder.params.ids   = ids || []
            anythingOrder.params.order = perPage * (currentPage - 1) + 1

            $.post(window.ajaxurl, anythingOrder.params, function(r){
                var json = JSON.parse(r)
                
                if(json.redirect){
                    window.location.href = json.redirect
                }

                if(anythingOrder.params.ids.length){
                    setTimeout(function(){
                        getItems().filter('.sorted').removeClass('sorted')
                    }, 300)
                }
                endUpdate()
            })
        }

      , endUpdate = function(){
            _list.sortable('enable')
            _spin.removeClass('spinner')
        }

      , getItems = function(){
            return _list.children('tr:not(.inline-editor)')
        }

      , select = function(e){
            if(e.ctrlKey || e.metaKey){
                $(this).toggleClass('selected')
            }else if(e.shiftKey){
                var items = getItems()
                  , from  = items.index(items.filter('.selected').first())
                  , to    = items.index(this)

                if(-1 == from){
                    $(this).toggleClass('selected')
                }else{
                    if(from > to){
                        to = [from, from = items.index(this)][0]
                    }
                    items.slice(from, to+1).addClass('selected')
                }
            }
        }

      , getIds = function(e){
            var ids = [];
            for(var i=0; i<e.length; i++){
                ids.push(e[i].innerHTML)
            }
            return ids.join(',')
        }

      , _pref = $('input[name="anything-order-hide"]', '#adv-settings')

      , _reset = $('.anything-order-actions .reset', '#adv-settings').on('click', function(){
            if(!$(this).hasClass('disable')){
                if(confirm(anythingOrder.texts.confirmReset)){
                    doUpdate()
                }
            }

            return false
        })

      , refresh = function(){
            _list.sortable(_pref.prop('checked') ? 'enable' : 'disable')
            _reset[_pref.prop('checked') ? 'removeClass' : 'addClass']('disable')
        }

      , currentPage = $('.tablenav.top .pagination-links .current-page').val() || 1

      , perPage     = $('#adv-settings .screen-per-page').val()

      , revertInline = function(){
            if(undefined != window[anythingOrder.params.inline]){
                window[anythingOrder.params.inline].revert()
            }
      }

      , init = function(){
            $(document)
            .on('mousedown.anythig-order', '#the-list > tr:not(.inline-editor)', revertInline)
            .on('click.anythig-order', '#the-list > tr:not(.inline-editor)', select)
            .ajaxSend(function(e, xhr, o, undefined){
                if(-1 == o.data.indexOf('screen_id=') && undefined != window.pagenow){
                    o.data += '&screen_id='+window.pagenow
                }
            })

            _pref.on('click.anythig-order', refresh)

            refresh()
        }

    $( document ).keyup( function( e ) {
        if( e.which=== 27 || e.keyCode === 27 ) {
            if ( getItems().filter('.sorting').length > 0) {
                _list.addClass('cancel').sortable('cancel');
                $(document).mouseup();
            }
        }
    });

    init()
});
