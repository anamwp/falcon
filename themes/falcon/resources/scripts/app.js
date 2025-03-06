import domReady from '@roots/sage/client/dom-ready';
import { LogConsole, TestJquery } from './inc/test';
import Hello from './inc/test';

/**
 * Application entrypoint
 */
domReady(async () => {
	// ...
	// console.log('hello');
	LogConsole();
	Hello();
	TestJquery();
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
