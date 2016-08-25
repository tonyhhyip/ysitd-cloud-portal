import {optimize} from 'webpack';
import merge from 'webpack-merge';

const {UglifyJsPlugin} = optimize;

const baseConfig = {
  externals: {
    'react': 'React',
    'react-dom': 'ReactDOM',
    'classnames': 'classNames',
    'vue': 'Vue',
    'vue-resource': 'VueResource',
    'vue-material-components': 'VueMaterialComponents'
  },
  entry: {
    app: './resources/assets/js/app.js'
  },
  output: {
    path: 'public/js',
    publicPath: '/js',
    filename: 'app.min.js'
  },
  resolve: {
    extensions: ['', '.js', '.vue'],
    fallback: ['node_modules'],
    alias: {
      'images': 'public/images',
      'public': 'public'
    }
  },
  resolveLoader: {
    fallback:['node_modules']
  },
  module: {
    loaders: [
      {
        test: /\.vue$/,
        loader: 'vue'
      },
      {
        test: /\.js$/,
        loader: 'babel'
      },
      {
        test: /\.(png|jpe?g|gif|svg)$/,
        loader: 'url'
      }
    ]
  },
  vue: {
    html: {
      root: 'public'
    }
  }
};


const devConfig = merge(baseConfig, {
  output: {
    filename: 'app.js'
  }
});

const proConfig = merge(baseConfig, {
  plugins: [new UglifyJsPlugin({minimize: true})]
});

export {devConfig, proConfig};