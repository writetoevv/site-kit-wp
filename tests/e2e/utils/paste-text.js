/**
 * Simulate pasting text into an element.
 * It's necessary to get the underlying setter from the input's prototype
 * as this is overridden by elements rendered by React.
 *
 * @link https://stackoverflow.com/a/46012210/1037938
 */
export async function pasteText( selector, text ) {
	await page.$eval( selector, ( element, input ) => {
		Object.getOwnPropertyDescriptor( Object.getPrototypeOf( element ), 'value' )
			.set
			.call( element, input );

		element.dispatchEvent( new Event( 'input', { bubbles: true } ) );
	}, text );
}
