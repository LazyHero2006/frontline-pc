/**
 * Editor placeholder for frontline-pc/product-specs.
 *
 * No text fields: the row labels come from each product's own attribute names,
 * so they are edited under Produkter → Attributter. Giving the block its own
 * label editor would create a second, conflicting place to change them.
 *
 * Editor-only — see the note in product-stock/index.js.
 */
( function ( blocks, element, blockEditor, i18n ) {
	'use strict';

	var el = element.createElement;
	var __ = i18n.__;

	blocks.registerBlockType( 'frontline-pc/product-specs', {
		edit: function () {
			return el(
				'div',
				blockEditor.useBlockProps( { className: 'fl-editor-panel' } ),
				el( 'span', { className: 'fl-editor-panel__title' }, __( 'Spesifikasjoner', 'frontline-pc' ) ),
				el( 'span', { className: 'fl-editor-panel__note' },
					__( 'Rader og etiketter hentes fra produktets attributter. Endres under Produkter → Attributter.', 'frontline-pc' ) )
			);
		},
		save: function () {
			return null;
		}
	} );
}( window.wp.blocks, window.wp.element, window.wp.blockEditor, window.wp.i18n ) );
