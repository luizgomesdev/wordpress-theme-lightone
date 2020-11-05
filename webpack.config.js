const path = require('path')
const { CleanWebpackPlugin } = require('clean-webpack-plugin')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const UglifyJsPlugin = require('uglifyjs-webpack-plugin')
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')

// Paths
const BUILD_DIR = path.resolve(__dirname, 'public')
const IMG_DIR = path.resolve(__dirname, 'src/img')
const SCSS_DIR = path.resolve(__dirname, 'src/scss')
const JS_DIR = path.resolve(__dirname, 'src/js')

/**
 * Note: argv.mode will return 'development' or 'production'.
 *
 * @param argv
 */
const plugins = argv => [
	// Automatically remove all unused webpack assets on rebuild, when set to true in production.
	new CleanWebpackPlugin({
		cleanStaleWebpackAssets: argv.mode === 'production',
	}),
	new MiniCssExtractPlugin({
		filename: '../css/[name].css',
	}),
	new BrowserSyncPlugin({
		files: '**/*.php',
		proxy: 'http://blog.dev.tangerino.com.br',
	}),
]

module.exports = (env, argv) => ({
	context: path.resolve(__dirname, 'src'),

	entry: {
		index: [`${JS_DIR}/index.js`, `${SCSS_DIR}/index.js`],
	},

	output: {
		path: BUILD_DIR,
		filename: '[name].bundle.js',
	},

	module: [
		{
			test: /\.js$/,
			include: [JS_DIR],
			exclude: /node_modules/,
			use: 'babel-loader',
		},
		{
			test: /\.scss$/,
			exclude: /node_modules/,
			use: [MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader'],
		},
		{
			test: /\.(png|jpg|svg|jpeg|gif|ico)$/,
			use: {
				loader: 'file-loader',
				options: {
					name: '[path][name].[ext]',
					publicPath: process.env.NODE_ENV === 'production' ? '../' : '../../',
				},
			},
		},
		{
			test: /\.(ttf|otf|eot|svg|woff(2)?)(\?[a-z0-9]+)?$/,
			exclude: [IMG_DIR, /node_modules/],
			use: {
				loader: 'file-loader',
				options: {
					name: '[path][name].[ext]',
					publicPath: process.env.NODE_ENV === 'production' ? '../' : '../../',
				},
			},
		},
	],

	devtool: 'source-map',

	plugins: plugins(argv),

	externals: {
		jquery: 'jQuery',
	},

	optimization: {
		minimizer: [new UglifyJsPlugin({ cache: false, parallel: true, sourceMap: false })],
	},
})
