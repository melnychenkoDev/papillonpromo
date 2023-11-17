const path = require('path');
const webpack = require('webpack');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

const buildMode = process.env.BUILD_MODE;
let isProd = false;

switch (buildMode) {
	case 'prod':
		isProd = true;
		break;
	default:
		break;
}

const PATHS = {
	src: path.resolve(__dirname, 'src', 'pages'),
	build: path.resolve(__dirname, 'assets')
};

devtool = isProd ? undefined : 'source-map';

module.exports = {
	entry: {
		'main': PATHS.src+'/main.js',
		'front-page': PATHS.src+'/front-page.js',
		'about': PATHS.src+'/about.js',
		'contacts': PATHS.src+'/contacts.js',
		'news': PATHS.src+'/news.js',
		'releases': PATHS.src+'/releases.js',
	},
	output: {
		path: PATHS.build,
		clean: true,
		filename: 'js/[name].js',
		clean: true,
	},
	devtool,
	devServer: {
		port: 3000,
		open: true,
		hot: true,
	},
	plugins: [
		new webpack.DefinePlugin({
			'process.env.BUILD_MODE': JSON.stringify(process.env.USER_ROLE),
		}),
	 	new MiniCssExtractPlugin({
			filename: 'css/[name].css',
		}),
	],
	module: {
		rules: [
			{
				test: /\.html$/i,
				loader: 'html-loader',
			},
			{
				test: /\.(s|sa|sc)ss$/i,
				use: [
				 	!isProd ? "style-loader" : MiniCssExtractPlugin.loader,
					"css-loader",
					{
						loader: "postcss-loader",
						options: {
							postcssOptions: {
								plugins: [require('postcss-preset-env')],
							}
						}
					},
					{
						loader: 'sass-loader',
						options: {
							sourceMap: true,
						},
					},
				],
			},
			{
				test: /\.(?:js)$/,
				exclude: /node_modules/,
				use: {
					loader: 'babel-loader',
					options: {
						presets: ['@babel/preset-env'],
					}
				}
			},
			{
				test: /\.woff|\.eot|\.ttf$/,
				type: 'asset/resource',
				generator: {
					filename: 'fonts/[name][ext]',
				},
			},
			{
				test: /\.(jpe?g|png|webp|gif|svg)$/i,
				use: [
					{
						loader: 'image-webpack-loader',
						options: {
							mozjpeg: {
								progressive: true,
							},
							// optipng.enabled: false will disable optipng
							optipng: {
								enabled: false,
							},
							pngquant: {
								quality: [0.65, 0.90],
								speed: 4
							},
							gifsicle: {
								interlaced: false,
							},
							// the webp option will enable WEBP
							webp: {
								quality: 75
							}
						}
					},
				],
				type: 'asset/resource',
				generator: {
					filename: 'img/[name][ext]',
				},
			}
		]
	},
	resolve: {
		extensions: ['.js', '.ts', '.jsx', '.tsx', '.css', '.less', '.scss', '.sass']
	}
};