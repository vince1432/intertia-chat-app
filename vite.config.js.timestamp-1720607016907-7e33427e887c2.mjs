// vite.config.js
import vue from "file:///var/www/html/node_modules/@vitejs/plugin-vue/dist/index.mjs";
import laravel from "file:///var/www/html/node_modules/laravel-vite-plugin/dist/index.js";
import path from "path";
import { defineConfig } from "file:///var/www/html/node_modules/vite/dist/node/index.js";
var vite_config_default = defineConfig({
  server: {
    hmr: {
      host: "localhost"
    },
    watch: {
      usePolling: true
    }
  },
  resolve: {
    alias: {
      "ziggy-js": path.resolve("vendor/tightenco/ziggy")
    }
  },
  plugins: [
    laravel({
      input: ["resources/css/app.css", "resources/js/app.js"],
      refresh: true
    }),
    vue({
      template: {
        transformAssetUrls: {
          // The Vue plugin will re-write asset URLs, when referenced
          // in Single File Components, to point to the Laravel web
          // server. Setting this to `null` allows the Laravel plugin
          // to instead re-write asset URLs to point to the Vite
          // server instead.
          base: null,
          // The Vue plugin will parse absolute URLs and treat them
          // as absolute paths to files on disk. Setting this to
          // `false` will leave absolute URLs un-touched so they can
          // reference assets in the public directory as expected.
          includeAbsolute: false
        }
      }
    })
  ]
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCIvdmFyL3d3dy9odG1sXCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ZpbGVuYW1lID0gXCIvdmFyL3d3dy9odG1sL3ZpdGUuY29uZmlnLmpzXCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ltcG9ydF9tZXRhX3VybCA9IFwiZmlsZTovLy92YXIvd3d3L2h0bWwvdml0ZS5jb25maWcuanNcIjtpbXBvcnQgdnVlIGZyb20gXCJAdml0ZWpzL3BsdWdpbi12dWVcIjtcbmltcG9ydCBsYXJhdmVsIGZyb20gXCJsYXJhdmVsLXZpdGUtcGx1Z2luXCI7XG5pbXBvcnQgcGF0aCBmcm9tIFwicGF0aFwiO1xuaW1wb3J0IHsgZGVmaW5lQ29uZmlnIH0gZnJvbSBcInZpdGVcIjtcblxuZXhwb3J0IGRlZmF1bHQgZGVmaW5lQ29uZmlnKHtcbiAgICBzZXJ2ZXI6IHtcbiAgICAgICAgaG1yOiB7XG4gICAgICAgICAgICBob3N0OiBcImxvY2FsaG9zdFwiLFxuICAgICAgICB9LFxuICAgICAgICB3YXRjaDoge1xuICAgICAgICAgICAgdXNlUG9sbGluZzogdHJ1ZSxcbiAgICAgICAgfSxcbiAgICB9LFxuICAgIHJlc29sdmU6IHtcbiAgICAgICAgYWxpYXM6IHtcbiAgICAgICAgICAgIFwiemlnZ3ktanNcIjogcGF0aC5yZXNvbHZlKFwidmVuZG9yL3RpZ2h0ZW5jby96aWdneVwiKSxcbiAgICAgICAgfSxcbiAgICB9LFxuICAgIHBsdWdpbnM6IFtcbiAgICAgICAgbGFyYXZlbCh7XG4gICAgICAgICAgICBpbnB1dDogW1wicmVzb3VyY2VzL2Nzcy9hcHAuY3NzXCIsIFwicmVzb3VyY2VzL2pzL2FwcC5qc1wiXSxcbiAgICAgICAgICAgIHJlZnJlc2g6IHRydWUsXG4gICAgICAgIH0pLFxuICAgICAgICB2dWUoe1xuICAgICAgICAgICAgdGVtcGxhdGU6IHtcbiAgICAgICAgICAgICAgICB0cmFuc2Zvcm1Bc3NldFVybHM6IHtcbiAgICAgICAgICAgICAgICAgICAgLy8gVGhlIFZ1ZSBwbHVnaW4gd2lsbCByZS13cml0ZSBhc3NldCBVUkxzLCB3aGVuIHJlZmVyZW5jZWRcbiAgICAgICAgICAgICAgICAgICAgLy8gaW4gU2luZ2xlIEZpbGUgQ29tcG9uZW50cywgdG8gcG9pbnQgdG8gdGhlIExhcmF2ZWwgd2ViXG4gICAgICAgICAgICAgICAgICAgIC8vIHNlcnZlci4gU2V0dGluZyB0aGlzIHRvIGBudWxsYCBhbGxvd3MgdGhlIExhcmF2ZWwgcGx1Z2luXG4gICAgICAgICAgICAgICAgICAgIC8vIHRvIGluc3RlYWQgcmUtd3JpdGUgYXNzZXQgVVJMcyB0byBwb2ludCB0byB0aGUgVml0ZVxuICAgICAgICAgICAgICAgICAgICAvLyBzZXJ2ZXIgaW5zdGVhZC5cbiAgICAgICAgICAgICAgICAgICAgYmFzZTogbnVsbCxcblxuICAgICAgICAgICAgICAgICAgICAvLyBUaGUgVnVlIHBsdWdpbiB3aWxsIHBhcnNlIGFic29sdXRlIFVSTHMgYW5kIHRyZWF0IHRoZW1cbiAgICAgICAgICAgICAgICAgICAgLy8gYXMgYWJzb2x1dGUgcGF0aHMgdG8gZmlsZXMgb24gZGlzay4gU2V0dGluZyB0aGlzIHRvXG4gICAgICAgICAgICAgICAgICAgIC8vIGBmYWxzZWAgd2lsbCBsZWF2ZSBhYnNvbHV0ZSBVUkxzIHVuLXRvdWNoZWQgc28gdGhleSBjYW5cbiAgICAgICAgICAgICAgICAgICAgLy8gcmVmZXJlbmNlIGFzc2V0cyBpbiB0aGUgcHVibGljIGRpcmVjdG9yeSBhcyBleHBlY3RlZC5cbiAgICAgICAgICAgICAgICAgICAgaW5jbHVkZUFic29sdXRlOiBmYWxzZSxcbiAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgfSxcbiAgICAgICAgfSksXG4gICAgXSxcbn0pO1xuIl0sCiAgIm1hcHBpbmdzIjogIjtBQUF5TixPQUFPLFNBQVM7QUFDek8sT0FBTyxhQUFhO0FBQ3BCLE9BQU8sVUFBVTtBQUNqQixTQUFTLG9CQUFvQjtBQUU3QixJQUFPLHNCQUFRLGFBQWE7QUFBQSxFQUN4QixRQUFRO0FBQUEsSUFDSixLQUFLO0FBQUEsTUFDRCxNQUFNO0FBQUEsSUFDVjtBQUFBLElBQ0EsT0FBTztBQUFBLE1BQ0gsWUFBWTtBQUFBLElBQ2hCO0FBQUEsRUFDSjtBQUFBLEVBQ0EsU0FBUztBQUFBLElBQ0wsT0FBTztBQUFBLE1BQ0gsWUFBWSxLQUFLLFFBQVEsd0JBQXdCO0FBQUEsSUFDckQ7QUFBQSxFQUNKO0FBQUEsRUFDQSxTQUFTO0FBQUEsSUFDTCxRQUFRO0FBQUEsTUFDSixPQUFPLENBQUMseUJBQXlCLHFCQUFxQjtBQUFBLE1BQ3RELFNBQVM7QUFBQSxJQUNiLENBQUM7QUFBQSxJQUNELElBQUk7QUFBQSxNQUNBLFVBQVU7QUFBQSxRQUNOLG9CQUFvQjtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQSxVQU1oQixNQUFNO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQSxVQU1OLGlCQUFpQjtBQUFBLFFBQ3JCO0FBQUEsTUFDSjtBQUFBLElBQ0osQ0FBQztBQUFBLEVBQ0w7QUFDSixDQUFDOyIsCiAgIm5hbWVzIjogW10KfQo=
