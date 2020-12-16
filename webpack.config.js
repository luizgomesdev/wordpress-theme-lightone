const path = require('path')
const { CleanWebpackPlugin } = require('clean-webpack-plugin')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const UglifyJsPlugin = require('uglifyjs-webpack-plugin')
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')

// Directory paths.
const BUILD_DIR = path.resolve(__dirname, 'public')
const IMG_DIR = path.resolve(__dirname, 'src/assets/img')
const SCSS_DIR = path.resolve(__dirname, 'src/assets/sass')
const JS_DIR = path.resolve(__dirname, 'src/assets/js')

// You need to setup the proxy project URL
const PROXY_URL = ''

const entry = {
	main: [`${JS_DIR}/main.js`, `${SCSS_DIR}/global.scss`],
}

const output = {
	path: BUILD_DIR,
	filename: 'js/[name].bundle.js',
}

const plugins = argv => [
	new CleanWebpackPlugin({
		cleanStaleWebpackAssets: argv.mode === 'production', // Automatically remove all unused webpack assets on rebuild, when set to true in production. ( https://www.npmjs.com/package/clean-webpack-plugin#options-and-defaults-optional )
	}),

	new MiniCssExtractPlugin({
		filename: 'css/[name].css',
	}),

	new BrowserSyncPlugin({
		logLevel: 'silent',
		files: '**/*.php',
		proxy: PROXY_URL,
	}),
]

const rules = [
	{
		test: /\.js$/,
		include: [JS_DIR],
		exclude: /node_modules/,
		use: ['source-map-loader', 'babel-loader'],
		enforce: 'pre',
	},
	{
		test: /\.scss$/,
		exclude: /node_modules/,
		use: [MiniCssExtractPlugin.loader, 'css-loader', 'resolve-url-loader', 'sass-loader'],
	},
	{
		test: /\.(png|jpg|svg|jpeg|gif|ico)$/,
		use: {
			loader: 'file-loader',
			options: {
				name: 'img/[name].[ext]',
				publicPath: '../../../../',
			},
		},
	},
	{
		test: /\.(ttf|otf|eot|svg|woff(2)?)(\?[a-z0-9]+)?$/,
		exclude: [IMG_DIR, /node_modules/],
		use: {
			loader: 'file-loader',
			options: {
				name: 'fonts/[name].[ext]',
				publicPath: '../../../../',
			},
		},
	},
]

module.exports = (env, argv) => {
	return {
		watchOptions: {
			ignored: ['node_modules/**'],
		},

		context: path.resolve(__dirname),

		entry,

		output,

		/**
		 * A full SourceMap is emitted as a separate file ( e.g.  main.js.map )
		 * It adds a reference comment to the bundle so development tools know where to find it.
		 * set this to false if you don't need it
		 */
		devtool: 'source-map',

		module: {
			rules,
		},

		plugins: plugins(argv),

		externals: {
			jquery: 'jQuery',
		},

		optimization: {
			minimizer: [new UglifyJsPlugin({ cache: false, parallel: true, sourceMap: false })],
		},
	}
}
