# WordPress Site - Railway Deployment

This repository contains a WordPress site with custom themes deployed to Railway using GitHub Actions CI/CD.

## 🏗️ Architecture

- **Local Development**: Local by Flywheel
- **Production Hosting**: Railway.app (free tier)
- **Database**: Railway MySQL (included)
- **CI/CD**: GitHub Actions with automatic Railway deployments
- **Themes**: Sage theme with modern WordPress development stack

## 📁 Repository Structure

```
├── .github/workflows/deploy.yml    # CI/CD pipeline for Railway
├── wp-content/                     # WordPress themes and plugins
│   ├── themes/
│   │   ├── sage/                   # Sage theme (Laravel Blade + Tailwind)
│   │   ├── sage10-fse/             # Sage 10 FSE theme
│   │   ├── block-theme/            # Custom block theme
│   │   ├── frost/                  # WordPress core theme
│   │   └── twentytwentyfive/       # WordPress core theme
│   └── plugins/                    # WordPress plugins
├── Dockerfile                      # Railway container config
├── railway.toml                    # Railway build configuration
├── build-themes.sh                 # Automatic theme builder script
├── nixpacks.toml                   # Nixpacks build settings
├── wp-config-railway.php           # Railway WordPress config
└── README.md                       # This file
```

## 🚀 Deployment Process

1. **Push to main** → GitHub Actions triggered
2. **Build ALL tracked themes automatically**:
   - Scans `wp-content/themes/` for any theme with `package.json`
   - Builds each theme with npm/composer
   - Currently building: `sage`, `sage10-fse`, `block-theme`
3. **Clean up** development files (node_modules, etc.)
4. **Deploy to Railway** automatically
5. **WordPress runs** with Railway MySQL database

**That's it!** Railway handles the rest automatically.

## 🛠️ Local Development

### Prerequisites
- Local by Flywheel (or similar WordPress environment)
- Node.js 20+
- PHP 8.2+ (for Sage theme development)

### Development Workflow

```bash
# Work on Sage theme
cd wp-content/themes/sage
npm install
composer install
npm run dev

# Build for production testing
npm run build
```

### Deploying Changes

```bash
# From repository root
git add .
git commit -m "Update theme changes"
git push origin main
# → Automatic deployment via GitHub Actions
```

## ⚙️ Railway Setup

### Quick Start (5 minutes!)

1. **Create Railway account** at [railway.app](https://railway.app)
2. **Connect GitHub** repository
3. **Add MySQL database** service
4. **Deploy automatically** - Railway detects WordPress

### GitHub Actions Setup (Optional)

**Required Secrets** (GitHub repo → Settings → Secrets):

- `RAILWAY_TOKEN` - Get from Railway dashboard → Account Settings → Tokens
- `RAILWAY_SERVICE_ID` - Get from Railway service URL (optional)

### Manual Railway Deploy

```bash
# Install Railway CLI
npm install -g @railway/cli

# Login to Railway
railway login

# Link to project
railway link

# Deploy manually
railway up
```

## 📝 Theme Details

### Sage Theme (Primary)
- **Framework**: Laravel Blade + Tailwind CSS v4
- **Build Tool**: Vite
- **Features**: Modern WordPress development, PSR-4 autoloading
- **Location**: `wp-content/themes/sage/`

### Core Themes
- **Frost**: WordPress core block theme
- **Twenty Twenty-Five**: WordPress default theme

## 🔧 Configuration Files

### railway.toml
- Railway build configuration
- Defines build commands for themes
- Health check settings

### nixpacks.toml
- Nixpacks build configuration
- PHP and Node.js environment setup
- Start command configuration

### Dockerfile
- WordPress 6.4 + PHP 8.2 + Apache
- Copies wp-content with built themes
- Security headers and performance optimizations

### wp-config-railway.php
- Railway WordPress configuration
- Reads database from Railway's `DATABASE_URL`
- Environment-aware settings
- Performance and security settings

## 🚦 Commands

### Railway Management
```bash
# View Railway logs
railway logs

# Check deployment status
railway status

# Open app in browser
railway open

# Update deployment
git push origin main  # Triggers GitHub Actions
```

### Local Development
```bash
# Build Sage theme
cd wp-content/themes/sage
npm run build

# Start theme development
npm run dev

# Deploy to Railway
railway up
```

## 🔐 Environment Variables

### Railway Dashboard:
Railway automatically sets:
- `DATABASE_URL`: MySQL connection string
- `RAILWAY_PUBLIC_DOMAIN`: Your app domain
- `PORT`: Application port

### GitHub Secrets (Optional):
- `RAILWAY_TOKEN`: For GitHub Actions deployment
- `RAILWAY_SERVICE_ID`: Service identifier

## 📊 Monitoring

- **Railway Dashboard**: View metrics, logs, and deployments
- **Application Logs**: `railway logs` or web dashboard
- **Database**: Railway MySQL dashboard with metrics
- **Uptime**: Railway handles health checks automatically

## 🌐 Custom Domain & SSL

Railway provides:
- ✅ **Free subdomain**: `yourapp.railway.app`
- ✅ **HTTPS** automatically enabled
- ✅ **Custom domains** available on paid plans

**Add Custom Domain:**
1. Go to Railway dashboard → Settings → Domains
2. Add your domain
3. Update DNS to point to Railway
4. SSL certificate generated automatically

## 🤝 Contributing

1. Create feature branch
2. Make changes locally
3. Test with `npm run build` in theme directories
4. Commit and push
5. Automatic deployment via GitHub Actions

## 📄 License

This project follows WordPress licensing standards.

---

**Local Development**: Local by Flywheel
**Production**: Railway.app (free tier)
**Database**: Railway MySQL (included)
**CI/CD**: GitHub Actions with Railway deployment
**Cost**: $0/month 🎉
