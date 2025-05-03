/** @type {import('next').NextConfig} */
const nextConfig = {
  eslint: {
    ignoreDuringBuilds: true,
  },
  typescript: {
    ignoreBuildErrors: true,
  },
  images: {
    unoptimized: true,
    domains: ['localhost'], // Adicione o domínio do Laravel para as imagens
  },
  basePath: '/escalando-agora',
  experimental: {
    webpackBuildWorker: true,
    parallelServerBuildTraces: true,
    parallelServerCompiles: true,
  },
  async rewrites() {
    return [
      {
        source: '/api/v1/:path*',
        destination: process.env.LARAVEL_API_URL || 'http://localhost:8000/api/v1/:path*',
      },
    ];
  },
}

export default nextConfig; 