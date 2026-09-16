/**
 * Editor UI for frontline-pc/product-installment.
 *
 * Editor-only — see the note in product-stock/index.js.
 */
( function ( blocks, element, blockEditor, i18n ) {
	'use strict';

	var el = element.createElement;
	var __ = i18n.__;

	var FIELDS = [
		[ 'fromLabel', __( 'fra', 'frontline-pc' ) ],
		[ 'perMonthLabel', __( '/mnd', 'frontline-pc' ) ]
	];

	blocks.registerBlockType( 'frontline-pc/product-installment', {
		edit: function ( props ) {
			return el(
				'div',
				blockEditor.useBlockProps( { className: 'fl-editor-panel' } ),
				el( 'span', { className: 'fl-editor-panel__title' }, __( 'Delbetaling', 'frontline-pc' ) ),
				FIELDS.map( function ( field ) {
					var key = field[ 0 ];
					return el(
						'span',
						{ className: 'fl-editor-field', key: key },
						el( blockEditor.RichText, {
							tagName: 'span',
							allowedFormats: [],
							value: props.attributes[ key ],
							placeholder: field[ 1 ],
							onChange: function ( value ) {
								var next = {};
								next[ key ] = value;
								props.setAttributes( next );
							}
						} )
					);
				} ),
				el( 'span', { className: 'fl-editor-panel__note' },
					__( 'Vises bare når en ekte månedspris er koblet til.', 'frontline-pc' ) )
			);
		},
		save: function () {
			return null;
		}
	} );
}( window.wp.blocks, window.wp.element, window.wp.blockEditor, window.wp.i18n ) );
