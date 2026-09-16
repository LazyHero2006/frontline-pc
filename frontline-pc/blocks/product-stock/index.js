/**
 * Editor UI for frontline-pc/product-stock.
 *
 * Editor-only: registered through block.json's editorScript, never as script
 * or viewScript, so nothing from this file reaches a front-end page. Written
 * against the wp.* globals — no JSX and no bundler, so the theme stays
 * copy-deployable.
 */
( function ( blocks, element, blockEditor, i18n ) {
	'use strict';

	var el = element.createElement;
	var __ = i18n.__;

	var FIELDS = [
		[ 'inStockLabel', __( 'På lager', 'frontline-pc' ) ],
		[ 'backorderLabel', __( 'På restordre', 'frontline-pc' ) ],
		[ 'outOfStockLabel', __( 'Utsolgt', 'frontline-pc' ) ]
	];

	blocks.registerBlockType( 'frontline-pc/product-stock', {
		edit: function ( props ) {
			return el(
				'div',
				blockEditor.useBlockProps( { className: 'fl-editor-panel' } ),
				el( 'span', { className: 'fl-editor-panel__title' }, __( 'Lagerstatus', 'frontline-pc' ) ),
				FIELDS.map( function ( field ) {
					var key = field[ 0 ];
					var fallback = field[ 1 ];
					return el(
						'span',
						{ className: 'fl-editor-field', key: key },
						el( blockEditor.RichText, {
							tagName: 'span',
							allowedFormats: [],
							value: props.attributes[ key ],
							placeholder: fallback,
							onChange: function ( value ) {
								var next = {};
								next[ key ] = value;
								props.setAttributes( next );
							}
						} )
					);
				} )
			);
		},
		save: function () {
			return null;
		}
	} );
}( window.wp.blocks, window.wp.element, window.wp.blockEditor, window.wp.i18n ) );
