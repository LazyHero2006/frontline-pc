/**
 * Editor placeholder for frontline-pc/product-price.
 *
 * No text fields: the value comes from WooCommerce. Editor-only — see the note
 * in product-stock/index.js.
 */
( function ( blocks, element, blockEditor, i18n ) {
	'use strict';

	var el = element.createElement;
	var __ = i18n.__;

	blocks.registerBlockType( 'frontline-pc/product-price', {
		edit: function () {
			return el(
				'div',
				blockEditor.useBlockProps( { className: 'fl-editor-panel' } ),
				el( 'span', { className: 'fl-editor-panel__title' }, __( 'Pris', 'frontline-pc' ) ),
				el( 'span', { className: 'fl-editor-panel__note' },
					__( 'Hentes fra produktet. Endres under Produkter.', 'frontline-pc' ) )
			);
		},
		save: function () {
			return null;
		}
	} );
}( window.wp.blocks, window.wp.element, window.wp.blockEditor, window.wp.i18n ) );
