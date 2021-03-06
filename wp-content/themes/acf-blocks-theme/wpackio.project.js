const pkg = require('./package.json');

module.exports = {
	// Project Identity
	appName: 'acfBlocksTheme', // Unique name of your project
	type: 'theme', // Plugin or theme
	slug: 'acf-blocks-theme', // Plugin or Theme slug, basically the directory name under `wp-content/<themes|plugins>`
	// Used to generate banners on top of compiled stuff
	bannerConfig: {
		name: 'acfBlocksTheme',
		author: '',
		license: 'UNLICENSED',
		link: 'UNLICENSED',
		version: pkg.version,
		copyrightText:
			'This software is released under the UNLICENSED License\nhttps://opensource.org/licenses/UNLICENSED',
		credit: true,
	},
	// Files we need to compile, and where to put
	files: [
		// If this has length === 1, then single compiler
		// {
		// 	name: 'mobile',
		// 	entry: {
		// 		// mention each non-interdependent files as entry points
		//      // The keys of the object will be used to generate filenames
		//      // The values can be string or Array of strings (string|string[])
		//      // But unlike webpack itself, it can not be anything else
		//      // <https://webpack.js.org/concepts/#entry>
		//      // You do not need to worry about file-size, because we would do
		//      // code splitting automatically. When using ES6 modules, forget
		//      // global namespace pollutions 😉
		// 		vendor: './src/mobile/vendor.js', // Could be a string
		// 		main: ['./src/mobile/index.js'], // Or an array of string (string[])
		// 	},
		// 	// Extra webpack config to be passed directly
		// 	webpackConfig: undefined,
		// },
		// If has more length, then multi-compiler
		{
			name: 'app',
			entry: {
				// In PHP: enqueue->enqueue( 'app', 'main', [] );
				main: ['./resources/scripts/scripts.js'],
			},
			// Extra webpack config to be passed directly
			webpackConfig: undefined,
		},
	],
	// Output path relative to the context directory
	// We need relative path here, else, we can not map to publicPath
	outputPath: 'dist',
	// Project specific config
	// Needs react(jsx)?
	hasReact: false,
	// Needs sass?
	hasSass: true,
	// Needs less?
	hasLess: false,
	// Needs flowtype?
	hasFlow: false,
	// Externals
	// <https://webpack.js.org/configuration/externals/>
	externals: {
		jquery: 'jQuery',
	},
	module: {
        rules: [
            {
                test: require.resolve('jquery'),
                use: [{
                        loader: 'expose-loader',
                        options: 'jQuery'
                    },
                    {
                        loader: 'expose-loader',
                        options: '$'
                    }
                ]
            }
		],
		rules: [
			{
			  test: /\.s[ac]ss$/i,
			  use: [
				// Creates `style` nodes from JS strings
				'style-loader',
				// Translates CSS into CommonJS
				'css-loader',
				// Compiles Sass to CSS
				'sass-loader',
			  ],
			},
		]
	},
	// Webpack Aliases
	// <https://webpack.js.org/configuration/resolve/#resolve-alias>
	alias: undefined,
	// Show overlay on development
	errorOverlay: true,
	// Auto optimization by webpack
	// Split all common chunks with default config
	// <https://webpack.js.org/plugins/split-chunks-plugin/#optimization-splitchunks>
	// Won't hurt because we use PHP to automate loading
	optimizeSplitChunks: true,
	// Usually PHP and other files to watch and reload when changed
	watch: './(inc|theme)/**/*.php',
	// Files that you want to copy to your ultimate theme/plugin package
	// Supports glob matching from minimatch
	// @link <https://github.com/isaacs/minimatch#usage>
	packageFiles: [
		'inc/**',
		'scripts/vendor/**',
		'dist/**',
		'*.php',
		'*.md',
		'readme.txt',
		'languages/**',
		'theme/layouts/**',
		'LICENSE',
		'*.css',
	],
	// Path to package directory, relative to the root
	packageDirPath: 'package',
};
